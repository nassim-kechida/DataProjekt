<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = \Faker\Factory::create('fr_FR');
        $user = [];
        for($i=0; $i < 50; $i++){
            $user = new User();
            $user->setFirstname($faker->firstname());
            $user->setLastname($faker->lastname());
            $user->setEmail($faker->email());
            $user->setPassword($faker->password());
            $user->setCreatedAt(new\DateTime());
            $user->setBirthday(new\DateTime());
            $manager->persist($user);
            $users[]= $user;

        }

        $category =[];
        for($i=0; $i < 15; $i++){
            $category = new Category();
            $category->setTitle($faker->text(50));
            $category->setDescription($faker->text(250));
            $category->setImage($faker->imageUrl());
            $manager->persist($category);
            $categories[] = $category;
        }
        $articles = [];
        for($i=0; $i < 100; $i++){
            $article =new Article();
            $article->setTitle($faker->text(50));
            $article->setContent($faker->text(1000));
            $article->setImage($faker->imageUrl());
            $article->setCreatedAt(new\DateTime());
            $article->addCategory($categories[$faker->numberBetween(0,14)]);
            $article->setAuthor($users[$faker->numberBetween(0,49)]);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
