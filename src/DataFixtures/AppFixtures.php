<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\CategoryFactory;
use App\Factory\DetailFactory;
use App\Factory\OrderFactory;
use App\Factory\ProductFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        CategoryFactory::new()->createMany(20);

        ProductFactory::new()->createMany(100, function (){
            return [
                'categories' => CategoryFactory::randomRange(0,2)
            ];
        });

        UserFactory::new()->createMany(10);

        OrderFactory::new()->createMany(50, function(){
            return [
                '$products' => ProductFactory::randomRange(0,4)
            ];
        });

        $manager->flush();
    }
}
