<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\Operation;
use App\Entity\Port;
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
        //Creació de Port
        $portBCN = new Port();
        $portBCN->setCode('BCNESP')
            ->setCity('Barcelona')
            ->setCountry('Espanya')
            ->setName('Port de Barcelona');
        $manager->persist($portBCN);

        //Creació de Operations
        $numOperations = 5;
        for($i=1; $i<=$numOperations; $i++){
            $title = "Operativa " . $i;
            $type = "Desk Assistant";
            $code = "GYR00".$i;
            $portCode = "BCNESP";
            $dateStart = new \DateTime('@'.strtotime('now'));
            $dateEnd = new \DateTime('@'.strtotime('now'));
            $hourlyPay = 10.5;

            $operativa = new Operation();
            $operativa->setTitle($title)
                ->setType($type)
                ->setCode($code)
                ->setPortCode($portCode)
                ->setDateStart($dateStart)
                ->setDateEnd($dateEnd)
                ->setHourlyPay($hourlyPay)
                ->setPort($portBCN);
            $manager->persist($operativa);
        }

        $operativa01 = new Operation();
        $operativa01->setTitle('Encarregat de Check-out de passatgers')
            ->setType('Personal portuari')
            ->setCode('PRC01')
            ->setPortCode('BCNESP')
            ->setDateStart(new \DateTime('@'.strtotime('now')))
            ->setDateEnd(new \DateTime('@'.strtotime('now')))
            ->setHourlyPay(15.9)
            ->setPort($portBCN);

        $operativa02 = new Operation();
        $operativa02->setTitle('Rebuda de passatgers')
            ->setType('Personal portuari')
            ->setCode('PRC02')
            ->setPortCode('BCNESP')
            ->setDateStart(new \DateTime('@'.strtotime('now')))
            ->setDateEnd(new \DateTime('@'.strtotime('now')))
            ->setHourlyPay(15.9)
            ->setPort($portBCN);

        $operativa03 = new Operation();
        $operativa03->setTitle('Desk Assistant')
            ->setType('Personal portuari')
            ->setCode('PRC03')
            ->setPortCode('BCNESP')
            ->setDateStart(new \DateTime('@'.strtotime('now')))
            ->setDateEnd(new \DateTime('@'.strtotime('now')))
            ->setHourlyPay(10)
            ->setPort($portBCN);

        $operativa04 = new Operation();
        $operativa04->setTitle('Ajudant de guardamolls')
            ->setType('Personal portuari')
            ->setCode('PRC04')
            ->setPortCode('BCNESP')
            ->setDateStart(new \DateTime('@'.strtotime('now')))
            ->setDateEnd(new \DateTime('@'.strtotime('now')))
            ->setHourlyPay(10)
            ->setPort($portBCN);

        //Creació de Employees
        $numEmployees = 5;
        for ($i=1; $i<=$numEmployees; $i++){
            //Load Simple employees
            $name = 'Usuari '.$i;
            $surnames = 'Cognoms';
            $email = 'user_'.$i.'_mail@gmail.com';
            $password = 'password';
            $nif = "XXXXXXXXX".$i;
            $phoneNumber = $i.$i.$i.$i.$i.$i.$i.$i.$i;
            $birthday = new \DateTime('@'.strtotime('now'));
            $address = "C/ Rambla Gran 14 Barcelona, Espanya";
            $postcode = 12458;
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
                ->setPostcode($postcode)
                ->setNss($nss)
                ->setNotes($notes)
                ->setSnsTwitter($sns_twitter)
                ->setSnsLinkedin($sns_linkedin);
            $manager->persist($employee);

            $operativa01->addEmployee($employee);
            $operativa02->addEmployee($employee);
            $operativa03->addEmployee($employee);
            $operativa04->addEmployee($employee);
        }

        $manager->persist($operativa01);
        $manager->persist($operativa02);
        $manager->persist($operativa03);
        $manager->persist($operativa04);

        $manager->flush();
    }
}
