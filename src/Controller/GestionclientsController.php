<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class GestionclientsController extends AbstractController
{
    /**
     * @Route("/client", name="client_list")
     */
    public function index(Request $request)
    {
        

        
        $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        return $this->render('gestionclients/index.html.twig', ['clients' => $clients , 'user' =>  $this->getUser()]);
    }
    /**
     * @Route("/Gestionclients/save")
     */
    public function save()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $client = new Client();
        $client->setRaison('personel');
        $client->setNom('foulen');
        $client->setPrenom('foulen');
        $client->setEmail('foulen@gamil.com');
        $client->setAdresse('city foulena');
        $client->setTelephone(55055055);
        $client->setFax(55505050);

        $entityManager->persist($client);
        $entityManager->flush();

        return new Response('Client enregitrée avec id ' . $client->getId());
    }
    /**
     * @Route("/Gestionclients/new", name="new_client")
     * Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('client_list');
        }
        return $this->render('gestionclients/new.html.twig', ['form' => $form->createView(),'user' =>  $this->getUser()]);
    }
    /**
     * @Route("/gestionclients/{id}", name="client_show")
     */
    public function show($id)
    {
        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);
        return $this->render('gestionclients/show.html.twig', array('client' => $client , 'user' =>  $this->getUser()));
    }

    /**
     * @Route("/gestionclients/edit/{id}", name="edit_client")
     * Method({"GET", "POST"})
     */

    public function edit(Request $request, $id)
    {
        $client = new Client();

        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('client_list' , array('user' =>  $this->getUser()));
        }
        return $this->render('gestionclients/edit.html.twig', ['form' => $form->createView(), 'user' =>  $this->getUser()]);
    }

    /**
     * @Route("/gestionclients/delete/{id}", name="delete_client")
     * @Method({"DELETE"})
     */

    public function delete(Request $request, $id)
    {

        $client = $this->getDoctrine()->getRepository(Client::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($client);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('client_list', array('user' =>  $this->getUser()));
    }
}
