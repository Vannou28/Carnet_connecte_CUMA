<?php

namespace App\DataFixtures;

use App\Entity\WhereMaterial;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use DateTime;

class WhereMaterialFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count(UserDetailsFixtures::ADDRESS_TOWN) + 1; $i++) {
            $whereMaterial = new WhereMaterial();
            $whereMaterial->setMaterial($this->getReference('material_' . $i));
            $whereMaterial->setTakeDate(new DateTime('now'));
            $manager->persist($whereMaterial);
        }
            $manager->flush();
    }
}
