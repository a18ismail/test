<?php

namespace App\Controller;

use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;

class DashboardController extends AbstractController
{

    //Controlador principal pel "Panell de Control"

    //TODO
    //UTILITZAR METODE PER COMPROBAR LOGIN
    //CHECK IF LOGGED IN
    //GET EMPLOYEE DATA
    //FALTA CONTROL DE PERMISOS/SESSIÓ

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(Request $request)
    {

        $session = $request->getSession();
        $employee_id = $session->get('id');

        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($employee_id);

        //var_dump(DashboardController::$employee->getId());
        return $this->render('main/templateLayout.html.twig', ['employee' => $employee ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request)
    {

        $session = $request->getSession();
        $employee_id = $session->get('id');

        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($employee_id);

        return $this->render('dashboard/profile.html.twig', ['employee' => $employee]);
        //return $this->render('dashboard/profile.html.twig');
    }

    /**
     * @Route("/operations", name="operations")
     */
    public function operations(Request $request)
    {

    }

    /**
     * @Route("/calendarOperations", name="calendarOperations")
     */
    public function calendarOperations(Request $request)
    {

    }

    /**
     * @Route("/calendarAvailability", name="calendarAvailability")
     */
    public function calendarAvailability(Request $request)
    {

    }

    /**
     * @Route("/notifications", name="notifications")
     */
    public function notifications(Request $request)
    {

    }

    /**
     * @Route("/mail", name="mail")
     */
    public function mail(Request $request)
    {

    }

    /**
     * @Route("/settings", name="settings")
     */
    public function settings(Request $request)
    {

    }
}
