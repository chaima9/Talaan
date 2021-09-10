<?php

namespace App\Controller;

use App\Entity\Territoire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TerritoireType;



class TerritoireController extends AbstractController
{
    /**
     * @Route("/territoire", name="territoire",methods={"GET"})
     */
    public function findall(): Response
    {   $repo=$this->getDoctrine()->getRepository(Territoire::class);
        $territoire=$repo->findAll();
        return $this->render('territoire/index.html.twig', [
            'controller_name' => 'TerritoireController',
            'territoire'=>$territoire,'user' =>  $this->getUser(),
        ]);
    }


    /**
     * @Route("/territoire/new", name="new_territoire")
     */
    public function index(Request $request)
    {
        $dep = new Territoire();
        $form = $this->createForm(TerritoireType::class,$dep);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $dep = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dep);
            $entityManager->flush();
            return $this->redirectToRoute('territoire'); }
      
       return $this->render('territoire/create.html.twig',['form'=>
       $form->createView(),'user' =>  $this->getUser(),
       ]);
      
    }


    /**
 * @Route("/departement/delete/{id}", name="delete_deparement")
 * Method({"DELETE"})
 */

public function delete( $id) 
{
    $opp = $this->getDoctrine()->getRepository(Territoire::class)->find($id);
    
    $entityManager = $this->getDoctrine()->getManager();

    $entityManager->remove($opp);
    $entityManager->flush();
    
    $response = new Response();
    $response->send();
    return $this->redirectToRoute('territoire');
    }
}
