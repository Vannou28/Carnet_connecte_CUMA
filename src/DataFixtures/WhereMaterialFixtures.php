<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\WhereMaterial;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class WhereMaterialFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR,fr');
        for ($i = 0; $i < count(UserDetailsFixtures::ADDRESS_TOWN) + 1; $i++) {
            $whereMaterial = new WhereMaterial();
            $whereMaterial->setMaterial($this->getReference('material_' . $i));
            $whereMaterial->setTakeDate($faker->dateTimeBetween('-4 week', '+1 week'));
            $whereMaterial->setUser($this->getReference('user_' .  $i));
            $manager->persist($whereMaterial);
        }
            $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
