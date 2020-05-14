<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\Supervisor;
use App\Entity\Administrator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class AppFixtures extends Fixture
{

    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $max = 5;
        for ($i=0; $i<$max; $i++){
            //Load Simple employees
            $name = 'Usuari '.$i;
            $surnames = 'Cognoms ';
            $email = 'user_'.$i.'_mail@gmail.com';
            $password = 'password';
            $nif = "XXXXXXXXX".$i;
            $phoneNumber = $i.$i.$i.$i.$i.$i.$i.$i.$i;
            $birthday = new \DateTime('@'.strtotime('now'));
            $address = "C/ Rambla Barcelona";
            $nss = "123456789";
            $notes = "Afegeix més informació sobre tu!";
            $sns_twitter = "https://www.twitter.com";
            $sns_linkedin = "https://www.linkedin.com";

            $employee = new Employee();
            $employee->setEmail($email)
                ->setName($name)
                ->setSurnames($surnames)
                ->setPassword($password)
                ->setNif($nif)
                ->setPhoneNumber($phoneNumber)
                ->setBirthday($birthday)
                ->setAddress($address)
                ->setNss($nss)
                ->setNotes($notes)
                ->setSnsTwitter($sns_twitter)
                ->setSnsLinkedin($sns_linkedin);
            $manager->persist($employee);

        }
        $manager->flush();
    }
}
