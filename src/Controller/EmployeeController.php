<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employee;

class EmployeeController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile($id)
    {
        // GET LOGGED USER
        // GET USER OBJECT
        $employee = null;
        return $this->render('employee/profile.html.twig');
    }
}
