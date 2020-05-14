<?php

namespace App\Controller;

use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('main/landingLayout.html.twig', [
            'login_status' => false,
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        //Per evitar problemes de sessió de moment tanquem la session cada vegada que s'intenta fer login
        $session = $request->getSession();
        $session->invalidate();

        //Rebre dades formulari Login
        $email = $request->get('inputEmail');
        $password = $request->get('inputPassword');

        // TODO
        //Netejar dades i codificar contrasenya
        //També es pot fer amb JS costat client
        //Millor fer en costat servidor per assegurar integritat

        //Comprobar dades de Empleat
        $employees = $this->getDoctrine()->getRepository(Employee::class)->checkEmployeeLogin($email, $password);

        //Render resultat de Login
        if ( sizeof($employees) == 0 ){
            return $this->render('baseLanding.html.twig');
        } else{

            //Conseguir ID
            $employee_id = $employees[0]->getId();

            //Com encara no tenim control de usuaris implementat, utilitzem sessions de PHP senzilles
            //La sessió només emmagatzema l'Id

            //Iniciem la sessió de l'empleat
            $session->start();
            $session->set('id', $employee_id);

            //Redirigir a Dashboard
            return new RedirectResponse($this->generateUrl('dashboard'));
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
            return $this->render('dashboard/profile.html.twig', ['employee' => $employee[0]]);
        }

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request)
    {
        $session = $request->getSession();
        $session->invalidate();

        return $this->render('main/logout.html.twig', [
            'login_status' => false,
        ]);
    }

}
