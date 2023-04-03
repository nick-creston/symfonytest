<?php

namespace App\DataFixtures;

use App\Entity\Tax;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tax = new Tax();
        $tax->setCountry('Italy');
        $tax->setCode('IT');
        $tax->setTax(22);
        $manager->persist($tax);

        $tax = new Tax();
        $tax->setCountry('Germany');
        $tax->setCode('DE');
        $tax->setTax(19);

        $manager->persist($tax);

        $tax = new Tax();
        $tax->setCountry('Greece');
        $tax->setCode('GR');
        $tax->setTax(24);

        $manager->persist($tax);

        $manager->flush();
    }
}
