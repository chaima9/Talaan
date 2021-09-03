<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PaysType;
use App\Entity\Pays;

class PaysController extends AbstractController
{
     /**
     * @Route("/pays", name="pays")
     */
    public function findall(): Response
    {   $repo=$this->getDoctrine()->getRepository(Pays::class);
        $dep=$repo->findAll();
        return $this->render('pays/index.html.twig', [
            'controller_name' => 'PaysController','user' =>  $this->getUser(),
            'pays'=>$dep
        ]);
    }


    /**
     * @Route("/pays/new", name="new_pays")
     */
    public function index(Request $request)
    {
        $dep = new Pays();
        $form = $this->createForm(PaysType::class,$dep);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $dep = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dep);
            $entityManager->flush();
            return $this->redirectToRoute('pays');   }
       return $this->render('pays/create.html.twig',['form'=>
       $form->createView(),'user' =>  $this->getUser()]);
        
    }


    /**
 * @Route("/pays/delete/{id}", name="delete_pays")
 * Method({"DELETE"})
 */

public function delete( $id) 
{
    $opp = $this->getDoctrine()->getRepository(Pays::class)->find($id);
    
    $entityManager = $this->getDoctrine()->getManager();

    $entityManager->remove($opp);
    $entityManager->flush();
    
    $response = new Response();
    $response->send();
    return $this->redirectToRoute('pays',array('user' =>  $this->getUser()));
    }
}

