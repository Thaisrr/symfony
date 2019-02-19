<?php

namespace App\Controller;

use function mysql_xdevapi\getSession;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SandboxController extends Controller
{
    /**
     * @Route("/sandbox.{_format}",
     *          name="sandbox",
     *          defaults={"_format": "html"},
     *          requirements={"_format" : "html|php"} )
     */
    public function index()
    {
        return $this->render('sandbox/index.html.twig', [
            'controller_name' => 'SandboxController',
            'title' => 'Title Sandbox Controller',
        ]);
    }

    /**
     * @Route("/debug.{_format}",
     *          name="debug",
     *          requirements={"_format": "html|php" })
     */
    public function debug()
    {
        $message = "Je suis une simple String";
        $liste = ['Albert', 'Micheline', 'Gérard', 'Estelle', 'Michou', 'Kéké'];
  //      $logger = $this->container->get('logger');
  //      $logger->addInfo("Présentation de Symfony");
        dump($message, $liste); // évite les échos et print_r. A enlever en prod
        return $this->render('sandbox/debug.html.twig', []);
    }


    /**
     * @Route("/param/{name}",
     *          defaults={"name": "Severus Snape"},
     *          name="param",
     *           requirements={ "name": "[a-z\s]+"}
     * )
     */
    public function param(Request $request, $name)

    {

        $age = $request->get("age");

        if (!$request->getSession()->has("message"))
        { //si le message dans la session n'existe pas
        $request->getSession()->set("message", "Hello World");
        }
        return $this->render('sandbox/param.html.twig', ['name' =>ucfirst($name), 'age' => $age]);
    }

    /**
     * @Route("/route/{behaviour}",
     *          name="behaviour",
     *          defaults={"behaviour": "404"},
     *          requirements={"behaviour": "404|redirect|forward"})
     */
    public function route($behaviour)
    {
        switch ($behaviour) {
            case '404':
                throw $this->createNotFoundException("Mmmmh, voilà qui est facheux. Il semblerait que la page n'existe pas.");
                break;
            case 'redirect':
                // quand il y a redirection, il y a un changement dans l'adresse
                return $this->redirect($this->generateUrl('sandbox'));
                break;
            case 'forward':
                //pas de changement dans l'url
                return $this->forward('App\Controller\SandboxController::param', ['name'=>"Michou"]);
                break;
        }
    }

}
