
# E-commerce demo

Hello everyone this is my demo project about patikaEnUygun boocamp. I didn't finish it
yet but I want to explain what did I do until now.

**Before starting and explain my db and use case**

After you get get project and install all dependencies

- You mast change the .env file for mysql connection url and then create database
```
php bin/console doctrine:database:create
```
- After you create a database, now create migration and migrate them
```
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```
- After you execute migrations, now I used DataFixtures and Factory to add fake data in all my database tables, including relations, and you must execute
```
php bin/console doctrine:fixtures:load
```

Now we have fake data in our database tables.

#### This is my database uml diyagram
- The reason why I made category and products many to many relations it is that the project was design like that.
![Alt text](https://github.com/EagleGazii/PatikaEnUygunBootcamp_LastProject/blob/e242c9b9deb6ccb61bfd9b0b2d207c099662d416/e_com_db%20(2).jpg "Database UML Diyagram")


#### This is my use case for this demo_e-commerce
![Alt text](https://github.com/EagleGazii/PatikaEnUygunBootcamp_LastProject/blob/e242c9b9deb6ccb61bfd9b0b2d207c099662d416/e_com_use_case.jpg "Use Case Diyagram")



The project must be an e-commerce website, if someone want to buy any product they must register/login
to finish their orders.

- First the web must have a simple home,porducts page without any interaction
- After user will get register/login they can buy porducts
- **And Admin panel**

I finish at most all of the **admin** routes 

Routes | name | Method |  Path 
--- | --- | --- | --- 
1 | app_admin_order_approve  | GET |/admin/order/approved 
2 | app_admin_product | GET | /admin/product
3 | app_admin_delete_product | GET | /admin/product/delete
4 | app_admin_edit_product | GET/POST | /admin/product/edit
5 | app_admin_create_product | GET/POST | /admin/product/create
6 | app_admin_category | GET | /admin/category
7 | app_admin_show_users   | GET | /admin/user
8 | app_admin_edit_user  | GET/POST | /admin/user/edit
9 | app_register   | GET | /register
10 | app_login    | GET | /login
11 | app_logout   | GET | /logout

- After the project starts, because we have fake users we don't know how is users password, we need to go to /register, to register new account, after that go to database user table and change the use roles to "ROLE_ADMIN" and login to that account if you want to redirect to admin panel.
- I didn't make any route for "ROLE_USER" or for starting website looking, I just make:

Ready for this demo | task 
--- | --- 
1 | Authenication 
2 | Authorization
3 | Relations 
4 | admin routes 
5 | admin route-design
6 | DataFactory for all entities (add fake data to db)

I know I didn't finish the project as you want and when you want but I try it.
### Thank you [Patika](https://www.patika.dev/) and [EnUygun](https://www.linkedin.com/company/wingieenuygungroup/?originalSubdomain=tr) for **PHP SYMFONY** bootcamp. All the best!.  


