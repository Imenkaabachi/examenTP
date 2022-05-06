<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Etudiant extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker=Factory::create();
        for ($i=0;$i<100;$i++){
            $repo=$manager->getRepository(\App\Entity\Etudiant::class);
            $etudiant=new \App\Entity\Etudiant();
            $etudiant->setName($faker->name);
            $etudiant->setPrenom($faker->firstName);

                $random = rand(9,12);
                $section =$repo->findOneBy(['id'=>$random], []);
                $etudiant->setSection($section);

            $manager->persist($etudiant);
        }


        $manager->flush();
    }
}
