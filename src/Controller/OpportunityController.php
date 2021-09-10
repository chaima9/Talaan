<?php

namespace App\Controller;

use App\Entity\Opportunity;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\OpportunityType;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf as Snappy;

class OpportunityController extends AbstractController
{
    /**
     * @Route("/opportunity", name="opportunity")
     */
    public function index(): Response
    {   $repo=$this->getDoctrine()->getRepository(Opportunity::class);
        $opp=$repo->findAll();
        return $this->render('opportunity/index.html.twig', [
            'controller_name' => 'OpportunityController',
            'opportunites'=>$opp ,'user' =>  $this->getUser()
        ]);
    }

      /**
     * @Route("/opportunity/new", name="new_opportunity")
     * Method({"GET", "POST"})
     */
    public function create(Request $request): Response
    { 
            $user = $this->getUser();

        $opp = new Opportunity();
        $opp->setdatedesoumission(new \DateTime());
        $opp->setCommercial($user->getId());
        $opp->setNomcommercial($user->getPrenom());

        $form = $this->createForm(OpportunityType::class,$opp);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $opp = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($opp);
        $entityManager->flush();
        return $this->redirectToRoute('opportunity',array('user' =>  $this->getUser()));
        }
       
        return $this->render('opportunity/create.html.twig', [
            'controller_name' => 'OpportunityController',
            'form' => $form->createView(),'user' =>  $this->getUser()
            
        ]);
    }
    /**
     * @Route("/opportunity/libre", name="opportunity_libre")
     */
    public function findlibre()
    {   $op = $this->getDoctrine()->getRepository(Opportunity::class)->findBy( ['Statut' => 'Libre']);

        return $this->render('opportunity/libre.html.twig', [
            'controller_name' => 'OpportunityController','user' =>  $this->getUser(),
            'op'=>$op        ]);
        
    }
    /**
     * @Route("/opportunity/reservee", name="opportunity_reserve")
     */
    public function findreserve()
    {   $op = $this->getDoctrine()->getRepository(Opportunity::class)->findBy( ['Statut' => 'Reservee']);

        return $this->render('opportunity/details.html.twig', [
            'controller_name' => 'OpportunityController','user' =>  $this->getUser(),
            'op'=>$op        ]);
        
    }
    
    /**
 * @Route("/opportunity/edit/{id}", name="edit_opportunity")
 * Method({"GET", "POST"})
 */
 public function edit(Request $request, $id) {
    $opp = new Opportunity();
   $opp = $this->getDoctrine()->getRepository(Opportunity::class)->find($id);
   
    $form = $this->createForm(OpportunityType::class,$opp);
   
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
   
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
   
    return $this->redirectToRoute('opportunity');
    }
   
    return $this->render('opportunity/edit.html.twig', ['form' =>
   $form->createView(),'editmode'=>$opp->getStatut() !== 'Reservee','user' =>  $this->getUser(),
   'opp'=>$opp ]);


   
    }
       /**
 * @Route("/opportunity/delete/{id}", name="delete_opportunity")
 * Method({"DELETE"})
 */

    public function delete( $id) 
    {
        $opp = $this->getDoctrine()->getRepository(Opportunity::class)->find($id);
        
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($opp);
        $entityManager->flush();
        
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('opportunity');
        }

         /**
 * @Route("/opportunity/reserver/{id}", name="reserver_opportunity")
 * Method({"Post"})
 */

public function reserver( $id) 
{
    $opp = $this->getDoctrine()->getRepository(Opportunity::class)->find($id);
    $opp->setStatut("Reservee");
    $opp->setdatedattribution(new \DateTime());
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($opp);
    $entityManager->flush();
    
    $response = new Response();
    $response->send();
    return $this->redirectToRoute('opportunity');
    } 
           /**
 * @Route("/opportunity/pdf/{id}", name="rapport_opportunity")
 * 
 */ 
    public function pdf(\Knp\Snappy\Pdf $snappy,Request $request)
    {
        
        $id = $request->get("id"); //1

        

        $repository = $this->getDoctrine()->getRepository(Opportunity::class);
         $opportunite = $repository->find($id);

        $html = $this->renderView('opportunity/mypdf.html.twig', [
            'title' => 'Rapport', 'id'=> $id, 
            'commercial'=>$opportunite->getCommercial() ,
            'pays'=>$opportunite->getPays() ,
            'client'=>$opportunite->getClient() ,
            'territoire'=>$opportunite->getTerritoire() ,
            'etapedetransaction'=>$opportunite->getEtapedetransaction() ,
            'accord'=>$opportunite->getAccord() , 


            'confiance'=>$opportunite->getConfiance() ,'departement'=>$opportunite->getDepartement() ,'date_soumission'=>$opportunite->getDatedesoumission() ,
            'date_attribution'=>$opportunite->getDatedattribution() , 'val_total'=>$opportunite->getValeurtotale() , 'val_nette'=>$opportunite->getValeurnette() ,
            'status'=>$opportunite->getStatut() , 
        ] );

        $filename = 'rapport';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }



     /**
     * @Route("/opportunity/rapport", name="rapport")
     */
    public function rapport() 
    {
        $repository = $this->getDoctrine()->getRepository(Opportunity::class);

        $user = $this->getUser()->getId() ;



        $opp = $repository->findBy(['Statut' => 'Reservee', 'commercial'=> $user ]);



        return $this->render('rapport/index.html.twig', [
            'controller_name' => 'OpportunityController',
            'opportunites' => $opp,
            'user' =>  $this->getUser()
        ]);
    }


 /**
 * @Route("/opportunity/rapport/pdf", name="rapportpdf_opportunity")
 */ 
public function pdfRapport(\Knp\Snappy\Pdf $snappy)
{
    
   // $id = $request->get("id"); //1

    
   $repository = $this->getDoctrine()->getRepository(Opportunity::class);

   $user = $this->getUser()->getId() ;



   $opp = $repository->findBy(['Statut' => 'Reservee', 'commercial'=> $user ]);



   $html = $this->renderView('rapport/pdf.html.twig', [
       'controller_name' => 'OpportunityController',
       'opportunites' => $opp,
       'prenom' =>  $this->getUser()->getPrenom(),
       'nom' =>  $this->getUser()->getNom()

   ]);



   // $repository = $this->getDoctrine()->getRepository(Opportunity::class);
    // $opportunite = $repository->find($id);


    $filename = 'rapport';

    return new Response(
        $snappy->getOutputFromHtml($html),
        200,
        array(
            'Content-Type'          => 'application/pdf',
            'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
        )
    );
}


 /**
 * @Route("/opportunity/stat", name="stat_opportunity")
 * 
 */ 
public function stat(){
    $pieChart= new PieChart();
  //  $repository = $this->getDoctrine()->getRepository(Opportunity::class)->stat();

    $repository = $this->getDoctrine()->getRepository(Opportunity::class);
    $opportunite = $repository->findAll();
    


   
    $total=0;
    foreach($opportunite as $opp) {
        $total= $total+1;
    }
    
    $data= array();
    $stat=['territoire', 'valeurtotale'];
    $nb=0;
    array_push($data,$stat);
    foreach($opportunite as $opp) {
        $stat=array();
        array_push($stat,$opp->getTerritoire()->getNom(),(($opp->getValeurtotale()) *100)/$total);
        $nb=($opp->getValeurtotale() *100)/$total;
        $stat=[$opp->getTerritoire()->getNom(),$nb];
        array_push($data,$stat);
    }
    $pieChart->getData()->setArrayToDataTable(
        $data
    );
    $pieChart->getOptions()->setTitle('statistqiues des valeurs totale par territoire
    ');
    $pieChart->getOptions()->setHeight(500);
    $pieChart->getOptions()->setWidth(900);
    $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
    $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
    $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
    $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
    $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
    return $this->render('opportunity/stat.html.twig', array('piechart' =>
        $pieChart ,  'user' =>  $this->getUser()));
}
   
    
}
