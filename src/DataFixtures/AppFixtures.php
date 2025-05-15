<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\User\User;
use App\Product\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        //
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Create 3 users
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setEmail("user{$i}@demo.com");
            $user->setName($faker->name());
            $user->setRoles(['ROLE_USER']);
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, 'password123')
            );
            $manager->persist($user);

            // Create 5 products per user
            for ($j = 0; $j < 5; $j++) {
                $product = new Product();
                $product->setName($faker->words(2, true));
                $product->setDescription($faker->sentence());
                $product->setPrice($faker->randomFloat(2, 5, 500));
                $product->setLatitude($faker->latitude(5.2, 5.4));  // Abidjan-like area
                $product->setLongitude($faker->longitude(-4.1, -3.9));
                $product->setCreatedAt(new \DateTimeImmutable());
                $product->setOwner($user);

                $manager->persist($product);
            }
        }

        $manager->flush();
    }
    
}
