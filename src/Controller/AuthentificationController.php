<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class AuthentificationController
 * @package App\Controller
 * @Route("/admin")
 */
class AuthentificationController extends Controller
{
    /**
     * @Route("/", name="authentification")
     */
    public function index()
    {
        return $this->render('authentification/index.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    /**
     * @Route ("/login", name="authentification_login")
     */
    public  function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('authentification_check'))
            ->add('username', TextType::class, [
                'label' => "Identifiant : "
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de Passe : '
            ])
            ->add('login', SubmitType::class, [
                'label'=> "S'identifier"
            ])
            ->getForm();

        return $this->render('authentification/login.html.twig', [
            'formView' => $form->createView(),
            'error' => $error
        ]);
    }

    /**
     * @return Response
     * @Route("/check", name="authentification_check")
     */
    public function check()
    {
        return new Response();
    }

    /**
     * @return Response
     * @Route("/logout", name="authentification_logout")
     */
    public function logout()
    {
        return new Response();
    }

}
