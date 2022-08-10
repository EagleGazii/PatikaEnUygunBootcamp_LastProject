<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use App\Form\EditProductFormType;
use App\Form\EditUserFormType;
use App\Repository\CategoryRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    #[Route('/admin/order/approved', name: 'app_admin_order_approve',methods: ['GET'])]
    public function approveOrder(Request $request,ManagerRegistry $doctrine, OrderRepository $orderRepository)
    {
        $orderID = $request->query->get('orderIdForApprove');
        $entityManager = $doctrine->getManager();
        $orders = $orderRepository->findBy(['id'=>$orderID]);
        foreach ($orders as $order){
            $order->setApproved(true);
        }
        $entityManager->flush();
        return $this->redirect('/admin/order');

    }

        #[Route('/admin/order', name: 'app_admin',methods: ['GET'])]
        public function index(OrderRepository $orderRepository): Response
        {

            $approvedOrder = $orderRepository->getOrders(1);
            $disapprovedOrder = $orderRepository->getOrders(0);
            return $this->render('admin/order/order.html.twig', [
                'approvedOrder' => $approvedOrder,
                'disapprovedOrder' => $disapprovedOrder
            ]);
        }


        #[Route('/admin/product', name: 'app_admin_product',methods: ['GET'])]
        public function show(ProductRepository $productRepository):response{

            $products = $productRepository->getAllProducts(1);

            return $this->render('admin/product/listProduct.html.twig', [
                'products' => $products,
            ]);
        }
        #[Route('/admin/product/delete', name: 'app_admin_delete_product',methods: ['GET'])]
        public function delete(Request $request, ManagerRegistry $doctrine,ProductRepository $productRepository)
        {

            $product = $productRepository->find($request->query->get('id'));
            $entityManager = $doctrine->getManager();
            $product->setStatus(false);

            $entityManager->flush();


            return $this->redirect('/admin/product');

        }

        private function addProduct($product,$entityManager,$form, $optional='edit'){
            $product->setName($form->get('name')->getData());
            $product->setBrand($form->get('brand')->getData());
            $product->setStock($form->get('stock')->getData());
            $product->setDescription($form->get('description')->getData());
            $product->setStatus(true);
            $optional === 'edit' ? $product->setUpdatedAt(new \DateTimeImmutable()) : $product->setCreatedAt(new \DateTimeImmutable());;



            $entityManager->persist($product);
            $entityManager->flush();
        }

        #[Route('/admin/product/edit', name: 'app_admin_edit_product',methods: ['GET','POST'])]
        public function edit(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager):response
        {

            $product = $productRepository->find($request->query->get('id'));
            dd(gettype($product));
            $form = $this->createForm(EditProductFormType::class, $product);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->addProduct($product,$entityManager,$form,'edit');
                return $this->redirect('/admin/product');
            }


            return $this->render('admin/product/productForm.html.twig', [
                'form' => $form->createView()
            ]);


        }
        #[Route('/admin/product/create', name: 'app_admin_create_product',methods: ['GET','POST'])]
        public function createProduct(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager):response
        {

            $product = new Product();
            $form = $this->createForm(EditProductFormType::class, $product);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->addProduct($product,$entityManager,$form,'new');
                return $this->redirect('/admin/product');
            }


            return $this->render('admin/product/productForm.html.twig', [
                'form' => $form->createView()
            ]);


        }
        #[Route('/admin/category', name: 'app_admin_category',methods: ['GET'])]
        public function showCategory(CategoryRepository $categoryRepository, EntityManagerInterface $entityManager):response
        {

            $categories = $categoryRepository->getCategories(0);
            return $this->render('admin/category/category.html.twig', [
                    'categories'=>$categories
            ]);


        }
        #[Route('/admin/user', name: 'app_admin_show_users',methods: ['GET'])]
        public function showUsers(UserRepository $userRepository, EntityManagerInterface $entityManager):response
        {

            $users = $userRepository->getUsers();
            return $this->render('admin/user/listUser.html.twig', [
                'users'=>$users
            ]);


        }
        #[Route('/admin/user/edit', name: 'app_admin_edit_user',methods: ['GET','POST'])]
        public function editUser(Request  $request, UserRepository $userRepository, EntityManagerInterface $entityManager):response
        {
            $userID = $request->query->get('id');
            $user = $userRepository->find($userID);


            $form = $this->createForm(EditUserFormType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $user->setRoles($form->get('roles')->getData());
                $entityManager->flush();
                return $this->redirect('/admin/user');
            }


            return $this->render('admin/user/userForm.html.twig', [
                'form' => $form->createView()
            ]);





        }

}
