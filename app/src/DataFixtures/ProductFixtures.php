<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setName('case');
        $product->setPrice(20);
        $manager->persist($product);

        $product = new Product();
        $product->setName('headphones');
        $product->setPrice(100);
        $manager->persist($product);

        $manager->flush();
    }
}
