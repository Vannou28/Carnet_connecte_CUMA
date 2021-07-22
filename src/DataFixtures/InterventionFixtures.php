<?php

namespace App\DataFixtures;

use App\Entity\Intervention;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InterventionFixtures extends Fixture implements DependentFixtureInterface
{
    public const INFOS = [
        [
            'area' => 12.5,
            'tonne' => 4.4,
            'comment' => 'RAS',
        ],
        [
            'area' => 14,
            'tonne' => 6.2,
            'comment' => 'RAS',
        ],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::INFOS as $key => $info) {
            $intervention = new Intervention();
            $intervention ->setAera($info['area']);
            $intervention ->setweight($info['tonne']);
            $intervention ->setComment($info['comment']);
            $intervention->setMaterial($this->getReference('material_' . $key));
            $intervention->addUser($this->getReference('user_' . (count(UserDetailsFixtures::ADDRESS_TOWN))));
            $manager->persist($intervention);
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
