<?php

namespace App\Controller;

use App\Entity\Opportunity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\OpportunityType;

class ChiffreController extends AbstractController
{
    /**
     * @Route("/chiffre", name="chiffre")
     */
    public function index(): Response
    {
        $opportunites = $this->getDoctrine()->getRepository(Opportunity::class)->findBy(['Statut' => 'Reservee']);

        return $this->render('chiffre/index.html.twig', [
            'controller_name' => 'ChiffreController',
            'opportunites' => $opportunites,
            'user' =>  $this->getUser()

        ]);
    }
}
