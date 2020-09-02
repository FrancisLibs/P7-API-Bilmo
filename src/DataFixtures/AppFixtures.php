<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Phone;
use App\Entity\Customer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * Encodeur des mots de passe
     * 
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    private $brands = ['Apple', 'Samsung', 'nokia', 'Sony', 'Motorola', 'Huawei'];
    private $colors = ['black', 'white', 'red', 'white', 'blue'];
    

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

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

        for($u=0; $u < 10; $u++)
        {
            $user = new User();
            $hash = $this->encoder->encodePassword($user, "password");

            $user->setFirstName($faker->firstName())
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setPassword($hash);
            $manager->persist($user);

            for ($c=0; $c < mt_rand(5, 20); $c++)
            {
                $customer = new Customer();

                $customer->setFirstName($faker->firstname())
                    ->setlastName($faker->lastName)
                    ->setEmail($faker->email)
                    ->setCompany($faker->company)
                    ->setUser($user);

                $manager->persist($customer);
            }
        }

        $manager->flush();
    }
}
