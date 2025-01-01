<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\PatientType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Patient;



class PatientController extends AbstractController
{
    
    #[Route('/patients',name:'patients')]
    public function showAll(EntityManagerInterface $entityManager): Response
   {
        $patient = $entityManager->getRepository(Patient::class)->findAll();
        return $this->render('patients/show.html.twig', ['patient' => $patient]);
   }
   #[Route('/patients/add',name:'add_patient')]
   public function new(EntityManagerInterface $entityManager,Request $request): Response
   {
     
       $patient = new Patient();
       $form = $this->createForm(PatientType::class, $patient);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
          $patient = $form->getData();
          $entityManager->persist($patient);
          $entityManager->flush();
          return $this->redirectToRoute('patients');
         
      }
       return $this->render('patients/add.html.twig',['form'=>$form->createView()]);
   }
   
}
