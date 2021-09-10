<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'HomeController',
    ]);
    }

    /**
     * @Route("/historique", name="historique")
     */
    public function historique(): Response
    {
        return $this->render('front/historique.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation(): Response
    {
        return $this->render('front/presentation.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/bonne_gouvernance", name="bonnegouv")
     */
    public function bonne_gouvernance(): Response
    {
        return $this->render('front/bonne_gouvernance.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/acces_relation", name="acces_relation")
     */
    public function acces_relation(): Response
    {
        return $this->render('front/acces_relation.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/bureau_relation_citoyen", name="bureau")
     */
    public function bureau_relation_citoyen(): Response
    {
        return $this->render('front/bureau_relation_citoyen.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/flotte_tanit", name="flottetanit")
     */
    public function flotte_tanit(): Response
    {
        return $this->render('front/flotte_tanit.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/flotte_carthage", name="flottecarthage")
     */
    public function flotte_carthage(): Response
    {
        return $this->render('front/flotte_carthage.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/condition_utilisation", name="conditionutilisation")
     */
    public function condition_utilisation(): Response
    {
        return $this->render('front/condition_utilisation.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/reclamation_passagers", name="reclamation_passagers")
     */
    public function reclamation_passagers(): Response
    {
        return $this->render('front/reclamation_passagers.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/services", name="services")
     */
    public function services(): Response
    {
        return $this->render('front/services.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/reclamation_marchandise", name="reclamation_marchandise")
     */
    public function reclamation_marchandises(): Response
    {
        return $this->render('front/reclamation_marchandise.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/mediatheque", name="mediatheque")
     */
    public function mediatheque(): Response
    {
        return $this->render('front/mediatheque.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/bulletin_interne", name="bulletin_interne")
     */
    public function bulletin_interne(): Response
    {
        return $this->render('front/bulletin_interne.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/document_online", name="document_online")
     */
    public function document_online(): Response
    {
        return $this->render('front/document_online.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/appel_offres", name="appel_offres")
     */
    public function appel_offres(): Response
    {
        return $this->render('front/appel_offres.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/ _in", name="sign_in")
     */
    public function sign_in(): Response
    {
        return $this->render('front/sign_in.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/sign_up", name="sign_up")
     */
    public function sign_up(): Response
    {
        return $this->render('front/sign_up.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/profil", name="profil")
     */
    public function profile(): Response
    {
        $user=$this->getUser();
        return $this->render('front/profil.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user
        ]);
    }
}
