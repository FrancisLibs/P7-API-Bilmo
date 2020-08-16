<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PhoneFixtures extends Fixture
{
    private $brands = ['Apple', 'Samsung', 'nokia', 'Sony', 'Motorola', 'Huawei'];
    private $colors = ['black', 'white', 'red', 'white', 'blue'];

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 20; $i++) {
            $phone = new Phone();
            $phone->setBrand($this->brands[rand(0, 4)] . ' ' . rand(5, 8));
            $phone->setColor($this->colors[rand(0, 4)]);
            $phone->setPrice(rand(100, 1000));
            $phone->setDescription('A wonderful phone with ' . rand(10, 50) . ' tricks');

            $manager->persist($phone);
        }
        $manager->flush();
    }
}
