<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class VideosController extends Controller
{
    /**
     * @Route("/videos/{name}",
     *          name="videos",
     *     defaults={"name":"video1"} )
     *
     */
    public function index($name)
    {

        switch ($name) {
            case "video1":
                $code = "aWgDKIr3VmQ";
                break;
            case "video2":
                $code = "uttlRqHpvN";
                break;
            case "video3":
                $code = "FmkAcGz1BJk";
                break;
            default :
                throw $this->createNotFoundException("Mmmmh, voilà qui est facheux. Il semblerait que la video n'existe pas.");
        }
                return $this->render('videos/index.html.twig', ['code' =>$code]);

    }
}
