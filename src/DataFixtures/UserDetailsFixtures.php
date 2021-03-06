<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserDetails;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserDetailsFixtures extends Fixture
{
    public const ADDRESS_TOWN = [
        [
            'address' => '22 place du martroi janville',
            'town' => 'Janville-en-Beauce',

        ],
        [
            'address' => '8 Rue du Maréchal Foch',
            'town' => 'Janville-en-Beauce',

        ],
        [
            'address' => '118 Rue nationale',
            'town' => 'Toury',

        ],
        [
            'address' => '93 Rue nationale',
            'town' => 'Toury',

        ],
        [
            'address' => '1 Rue du Vingt Trois Août 1944',
            'town' => 'Fresnay-l Évêque',

        ],
        [
            'address' => '15 Rue de la Mairie',
            'town' => 'Rouvray-Saint-Denis',

        ],
        [
            'address' => '1 Rue Charles Péguy',
            'town' => 'Santilly',

        ],
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR,fr');
        foreach (self::ADDRESS_TOWN as $key => $addressTown) {
            $userDetails = new UserDetails();
            $userDetails->setLastname($faker->lastName());
            $userDetails->setFirstname($faker->firstName());
            $userDetails->setAddress($addressTown['address']);
            $userDetails->setPostalCode(28310);
            $userDetails->setTown($addressTown['town']);
            $userDetails->setCountry('FRANCE');
            $userDetails->setPhone($faker->phoneNumber());

            $manager->persist($userDetails);
            $this->addReference('userDetails_' . $key, $userDetails);
        }

        $userDetails = new UserDetails();
        $userDetails->setLastname('Vannier');
        $userDetails->setFirstname('Aurélien');
        $userDetails->setAddress('OUTROUVILLE');
        $userDetails->setPostalCode(28310);
        $userDetails->setTown('JANVILLE EN BEAUCE');
        $userDetails->setCountry('FRANCE');
        $userDetails->setPhone($faker->phoneNumber());

        $manager->persist($userDetails);
        $this->addReference('userDetails_' . (COUNT(self::ADDRESS_TOWN)), $userDetails);

        $userDetails = new UserDetails();
        $userDetails->setLastname('LeBosse');
        $userDetails->setFirstname('Patron');
        $userDetails->setAddress('dans ma rue');
        $userDetails->setPostalCode(28310);
        $userDetails->setTown('OUTROUVILLE');
        $userDetails->setCountry('FRANCE');
        $userDetails->setPhone($faker->phoneNumber());

        $manager->persist($userDetails);
        $this->addReference('userDetails_' . (COUNT(self::ADDRESS_TOWN) + 1), $userDetails);

        $manager->flush();
    }
}
