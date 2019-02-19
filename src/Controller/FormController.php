<?php

namespace App\Controller;


use App\Form\LivreType;
use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends Controller
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('mail', EmailType::class)
            ->add('message', TextareaType::class)
            ->getForm();

        $form->handleRequest($request); // pour récupérer les données et les mettres dans l'instance du form
        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            dump($data);
        }
        return $this->render('form/index.html.twig', [
            'formView' => $form->createView(),
        ]);
    }

    /**
     * @Route("/livre/ajouter", name="livre_ajouter")
     */
    public function ajouterLivre(Request $request)
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->add('ajouter', SubmitType::class, [
            'label'=>'Ajouter'
        ]);

        $form->handleRequest($request); // pour récupérer les données et les mettres dans l'instance du form
        if ($form->isSubmitted() && $form->isValid())
        {
            $livre = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($livre);
            $em->flush();

            return$this->redirectToRoute('livre_ajouter');
        }

        return $this->render('form/ajouter_livre.html.twig', [
            'formView'=>$form->createView()
        ]);
    }
}
