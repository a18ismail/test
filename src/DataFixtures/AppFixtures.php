<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\Supervisor;
use App\Entity\Administrator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $max = 5;
        for ($i=0; $i<$max; $i++){
            //Load Simple employees
            $name = 'User '.$i;
            $surnames = 'Surname '.$i;
            $email = 'user_'.$i.'_mail@gmail.com';
            $password = 'password';
            $nif = "XXXXXXXXX".$i;

            $employee = new Employee();
            $employee->setEmail($email)
                ->setName($name)
                ->setSurnames($surnames)
                ->setPassword($password)
                ->setNif($nif);
            $manager->persist($employee);

        }
        $manager->flush();
    }
}
