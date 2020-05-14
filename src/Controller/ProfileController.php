<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    /**
     * @Route("/indexProfile", name="indexProfile")
     */
    public function index()
    {
        //AQUEST METODE NO L'UTILITZEM ARA
        //POTSER PASSEM EL profile() de DashboardController aqui mes en davant
        //

        /*return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);*/
    }

    /**
     * @Route("/editProfile", name="editProfile")
     */
    public function editProfile(Request $request)
    {
        //Aqui actualitzem les dades del empleat registrat

        //Conseguim ID per poder editar l'objecte
        $session = $request->getSession();
        $employee_id = $session->get('id');

        //Fem un update de l'empleat per actualitzar les seves dades

        //Finalment enviem una resposta
        //Ja que aquest metode nomes ha de rebre una petició POST i fer un update, no fem cap render de templates
        //Simplement respondem amb una resposta HTTP.
        //Aquesta resposta podra ser rebuda pel JS del perfil
        // i mostrar una alerta/notificacio avisant del resultat per exemple

    }
}
