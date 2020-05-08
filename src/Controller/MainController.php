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
        // TODO

        // PROVISIONAL
       /* $entityManager = $this->getDoctrine()->getManager();

        $newEmployee = new Employee();
        $newEmployee->setName('Prova');
        $newEmployee->setSurnames('ProvaProva');
        $newEmployee->setNif('XXXXXXXXX');
        $newEmployee->setEmail($email);
        $newEmployee->setPassword($password);

        $entityManager->persist($newEmployee);
        $entityManager->flush();*/

        //Comprobar dades de Empleat
        $employee = $this->getDoctrine()->getRepository(Employee::class)->checkEmployeeLogin($email, $password);

        //Render resultat de Login
        if ( sizeof($employee) == 0 ){
            return $this->render('base.html.twig');
        } else{
            return $this->render('dashboard/profile.html.twig', ['employee' => $employee, 'login_status' => true]);
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
