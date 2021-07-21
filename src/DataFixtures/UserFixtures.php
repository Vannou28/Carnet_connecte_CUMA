<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR,fr');
        for ($i = 0; $i < count(UserDetailsFixtures::ADDRESS_TOWN); $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setUserDetails($this->getReference('userDetails_' . $i));
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'user'
            ));
            $this->addReference('user_' . $i, $user);

            $manager->persist($user);
        }

        $user = new User();
        $user->setEmail('vannier.aurelien@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setUserDetails($this->getReference('userDetails_' . (count(UserDetailsFixtures::ADDRESS_TOWN) + 1)));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'user'
        ));
        $this->addReference('user_' . (count(UserDetailsFixtures::ADDRESS_TOWN) + 1), $user);

        $manager->persist($user);

        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'
        ));
        $this->addReference('user_admin', $admin);

        $manager->persist($admin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserDetailsFixtures::class
        ];
    }
}
