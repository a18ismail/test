<?php

namespace App\Controller;

use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'login_status' => false,
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        //Rebre dades formulari Login
        $email = $request->get('inputEmail');
        $password = $request->get('inputPassword');

        //Netejar dades i codificar contrasenya
        //També es pot fer amb JS costat client
        //Millor fer en costat servidor per assegurar integritat
        // TODO

        //Comprobar dades de Empleat
        $employee = $this->getDoctrine()->getRepository(Employee::class)->checkEmployeeLogin($email, $password);

        //Render resultat de Login
        if ( sizeof($employee) == 0 ){
            return $this->render('base.html.twig');
        } else{
            return $this->render('dashboard/profile.html.twig', ['employee' => $employee[0], 'login_status' => true]);
        }
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request)
    {
        //Rebre dades formulari de registre
        $email = $request->get('registerEmail');
        $password = $request->get('registerPassword');
        $name = $request->get('registerName');
        $surnames = $request->get('registerSurnames');

        // PROVISIONAL
        $entityManager = $this->getDoctrine()->getManager();

        $newEmployee = new Employee();
        $newEmployee->setName($name);
        $newEmployee->setSurnames($surnames);
        $newEmployee->setNif('XXXXXXXXX');
        $newEmployee->setPhoneNumber(1111111111);
        $newEmployee->setEmail($email);
        $newEmployee->setPassword($password);

        $entityManager->persist($newEmployee);
        $entityManager->flush();

        $employee = $this->getDoctrine()->getRepository(Employee::class)->checkEmployeeLogin($email, $password);

        if ( sizeof($employee) == 0 ){
            return $this->render('base.html.twig');
        } else{
            return $this->render('dashboard/profile.html.twig', ['employee' => $employee[0], 'login_status' => true]);
        }

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        return $this->render('main/logout.html.twig', [
            'login_status' => false,
        ]);
    }
}
