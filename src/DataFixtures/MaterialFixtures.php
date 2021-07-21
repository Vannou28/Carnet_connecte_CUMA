<?php

namespace App\DataFixtures;

use App\Entity\Material;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MaterialFixtures extends Fixture
{
    public const MATERIALS = [
        [
            'name' => 'Suceuse',
            'tonneUnit' => true,
        ],
        [
            'name' => 'Broyeur',
            'tonneUnit' => false,
        ],
        [
            'name' => 'Epandeur',
            'tonneUnit' => true,
        ],
        [
            'name' => 'Lemken',
            'tonneUnit' => false,
        ],
        [
            'name' => 'Déchaumeur',
            'tonneUnit' => false,
        ],
        [
            'name' => 'Rouleau',
            'tonneUnit' => false,
        ],        [
            'name' => 'Germinator',
            'tonneUnit' => false,
        ],
        [
            'name' => 'Covercrop',
            'tonneUnit' => false,
        ],
        [
            'name' => 'Déchaumeur à disques',
            'tonneUnit' => false,
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::MATERIALS as $key => $materialData) {
            $material = new Material();
            $material->setName($materialData['name']);
            $material->setTonneUnit($materialData['tonneUnit']);
            $manager->persist($material);
            $this->addReference('material_' . $key, $material);
        }
        $manager->flush();
    }
}
