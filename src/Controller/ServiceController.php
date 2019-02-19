<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Service\Unique;
use App\Service\UniqueField;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends Controller
{
    /**
     * @Route("/service", name="service_index")
     */
    public function index(Unique $unique, UniqueField $uniqueField)
    {
        $message = $unique->getMessage();
        $unique->setMessage("Je suis le nouveau message du service. *o*");

        $auteurExist = $uniqueField->setEntity(Auteur::class)
            ->setParameter('id', 1)
            ->isExist();

        return $this->render('service/index.html.twig', [
            'message' => $message,
            'auteur_exist' => $auteurExist
        ]);

    }

    public function noroute(Unique $unique)
    {

        return $this->render('service/noroute.html.twig', [
            'message' => $unique->getMessage(),
        ]);

    }
}
