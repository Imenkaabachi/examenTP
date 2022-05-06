<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Personne;
use App\Form\EtudiantType;
use App\Form\PersonneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etudiant')]
class EtudiantController extends AbstractController
{
    #[Route('/', name: 'etudiant.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Etudiant::class);
        $etudiants = $repo->findAll();

        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }

    #[Route('/edit/{id?0}', name: 'etudiant.edit')]
    public function editEtudiant(Etudiant $etudiant=null,ManagerRegistry $doctrine,Request $request)
    {
        if (!$etudiant){
            $etudiant = new Etudiant();
        }
        $form=$this->createForm(EtudiantType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){

            $manager=$doctrine->getManager();
            $manager->persist($etudiant);
            $manager->flush();

            $this->addFlash('success','etudiant added successfully');

            return $this->redirectToRoute('etudiant.list');

        }else{

            return $this->render('personne/addEtudiant.html.twig', [
                'form' => $form->createView()
            ]);
        }




    }
}
