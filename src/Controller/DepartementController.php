<?php

namespace App\Controller;

use App\Entity\Departement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DepartementType;


class DepartementController extends AbstractController
{   
    /**
     * @Route("/departement", name="departement")
     */
    public function findall(): Response
    {   $repo=$this->getDoctrine()->getRepository(Departement::class);
        $dep=$repo->findAll();
        return $this->render('departement/index.html.twig', [
            'controller_name' => 'DepartementController',
            'user' =>  $this->getUser(),
            'dep'=>$dep
        ]);
    }


    /**
     * @Route("/departement/new", name="new_departement")
     */
    public function index(Request $request)
    {
        $dep = new Departement();
        $form = $this->createForm(DepartementType::class,$dep);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $dep = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dep);
            $entityManager->flush();
            return $this->redirectToRoute('departement',array('user' =>  $this->getUser())); }
      
       return $this->render('departement/create.html.twig',['form'=>
       $form->createView() , 'user' =>  $this->getUser()]);
      
    }


    /**
 * @Route("/departement/delete/{id}", name="delete_deparement")
 * Method({"DELETE"})
 */

public function delete( $id) 
{
    $opp = $this->getDoctrine()->getRepository(Departement::class)->find($id);
    
    $entityManager = $this->getDoctrine()->getManager();

    $entityManager->remove($opp);
    $entityManager->flush();
    
    $response = new Response();
    $response->send();
    return $this->redirectToRoute('departement',array('user' =>  $this->getUser()));
    }
}
