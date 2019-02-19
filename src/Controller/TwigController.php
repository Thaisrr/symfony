<?php

namespace App\Controller;

use App\Utils\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/twig")
 */
class TwigController extends Controller
{
    /**
     * @Route("/", name="twig")
     */
    public function index()
    {
        $person = new Person("Doe", "Jane");
        $liste= ["Vincent", "Adrien", "Saïd", "Mustapha", "Julien", "Jason", "Maxime", "Thaïs", "Karine", "Sabrine", "Corentin", "PrincessHobbit" ];

        $tab = [];

        $users = [
            new Person("Targaryen, Khaleesi, Mysa, Mother of Dragons, true heir of the Seven Kingdoms, and more", "Daenerys"),
            new Person("Snow / Targaryen", "Jon / Aegon"),
            new Person("Lannister", "Tyrion"),
            new Person("Dumbledore", "Albus Brian Wulfric Perceval", false),
            new Person("Baelish", "Petyr", false),
            new Person("Stark", "Eddard", false)
        ];

        return $this->render('twig/index.html.twig', [
            'controller_name' => 'TwigController',
            'mon_message' => 'Hello World',
            'person' =>$person,
            'liste' =>$liste,
            'tab' =>$tab,
            'users' =>$users


        ]);
    }

    /**
     * @Route("/other", name="twig_other")
     */
    public function other()
    {
        $html = "<strong>Je suis un texte HTML ! </strong>";
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Europe/Paris'));

        return $this->render('/twig/other.html.twig', [
            'html'=>$html,
            'date'=>$date
        ]);
    }

    /**
     *  ici on ne met pas de route pour que ce ne soit pas accessible via une route.
     */
    public function video($superman)
    {
        sleep($superman);

        return $this->render('/twig/video.html.twig', [

        ] );
    }
}
