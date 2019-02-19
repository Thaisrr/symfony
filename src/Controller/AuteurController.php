<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auteur")
 */
class AuteurController extends Controller
{
    /**
     * @Route("/", name="auteur_index")
     */
    public function index(Request $request)
    {
        $auteur = new Auteur();
        $form =$this->createForm(AuteurType::class, $auteur);
        // on crée un nouveau formulaire, issu de Auteur Type, qui va utiliser la variable $auteur
        $form->add("ajouter", SubmitType::class, ['label'=>'ajouter']);

        $form->handleRequest( $request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $auteur = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();

            $this->addFlash("success", "Votre auteur a bien été ajouté.");

            return $this->redirectToRoute('auteur_index');
        }


        return $this->render('auteur/index.html.twig', [
            'formView' => $form->createView(),
        ]);
    }
}
