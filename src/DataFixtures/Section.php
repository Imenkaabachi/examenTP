<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Section extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $data=[
            'gl','rt','iia','imi'
        ];
        foreach ($data as $element){
            $section=new \App\Entity\Section();
            $section->setDesignation($element);

            $manager->persist($section);

        }

        $manager->flush();
    }
}
