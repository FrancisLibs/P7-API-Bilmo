<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Phone;
use App\Entity\Customer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private $brands = ['Apple', 'Samsung', 'nokia', 'Sony', 'Motorola', 'Huawei'];
    private $colors = ['black', 'white', 'red', 'white', 'blue'];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 50; $i++) {
            $phone = new Phone();
            $phone->setBrand($this->brands[mt_rand(0, 4)] . ' ' . rand(5, 8))
                ->setColor($this->colors[mt_rand(0, 4)])
                ->setPrice(mt_rand(100, 1000))
                ->setDescription('A wonderful phone with ' . mt_rand(10, 50) . ' tricks');

            $manager->persist($phone);
        }

        for ($c=0; $c < 30; $c++)
        {
            $customer = new Customer();

            $customer->setFirstName($faker->firstname())
                ->setlastName($faker->lastName)
                ->setEmail($faker->email)
                ->setCompany($faker->company);

            $manager->persist($customer);
        }

        $manager->flush();
    }
}
