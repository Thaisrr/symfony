<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EntityController
 * @package App\Controller
 *  @Route("/entity")
 */
class EntityController extends Controller
{
    /**
     * @Route("/", name="entity_index")
     */
    public function index(Request $request)
    {
        $livre = new Livre();
        $livre->setTitre("A Game of Throne");
        $livre->setResume("Spoiler :Robert meurt,  Nhed meurt, Catelyn meurt, Robb meurt, tout le monde meurt. ");
        $livre->setParution(new \DateTime("1996-08-08"));

        if (isset($_GET['submit'])) {
            $livre1 = new Livre();
            $livre1->setTitre($_GET['titre']);
            $livre1->setResume($_GET['resume']);
            $livre1->setParution($_GET['parution']);
        } else {
            $livre1=null;
        }

        // sauvegarde de mon livre quand ?action=save ( = dans l'url = query string, qu'on récupère en get )
        if( $request->query->get('action') == "save") {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livre);
            $em->flush();

            $this->addFlash("success", "Votre livre a bien été sauvegardé !");

            return $this->redirectToRoute('entity_index');
        }

        return $this->render('entity/index.html.twig', [
            'livre' => $livre, $livre1
        ]);
    }

    /**
     * @Route("/liste", name="entity_liste")
     */
    public function liste()
    {
        /**
         * Pour accéder au repo/ On peut aussi y ajouter nos propres méthodes.
         * -> findAll : trouver tous les champs
         */

        $repository = $this->getDoctrine()->getRepository(Livre::class) ;
       // $livres = $repository->findAll();
        $livres = $repository->findAllJoinAuteur();

        return $this->render('entity/liste.html.twig', [
            'livres'=> $livres
        ]);
    }

    /**
     * @Route("/{id}", name="entity_detail", requirements={"id": "\d+"})
     */
    public function detail($id)
    {
        $repository = $this->getDoctrine()->getRepository(Livre::class) ;
        $livre = $repository->find($id);

        if(!$livre) {
            throw $this->createNotFoundException("Cette ,ressource n'existe pas");
        }

        return $this->render('entity/detail.html.twig', [
            'livre'=> $livre
        ]);
    }

    /**
     * @Route("/{titre}", name="entity_findByTitle")
     */
    public function findByTitle($titre)
    {
        $repository = $this->getDoctrine()->getRepository(Livre::class) ;
        $livres = $repository->findBy(['titre'=>$titre]);


        return $this->render('entity/liste.html.twig', [
            'livres'=> $livres
        ]);
    }

    /**
     * @Route("/search/{needle}", name="entity_search")
     */
    public function search($needle)
    {
        /** @var LivreRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Livre::class) ;
        $livres = $repository->search($needle);


        return $this->render('entity/liste.html.twig', [
            'livres'=> $livres
        ]);
    }

    /**
     * @Route("/search/{needle}", name="entity_search")
     */
    public function findByParution($needle)
    {
        /** @var LivreRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Livre::class) ;
        $livres = $repository->findLivreByParution();


        return $this->render('entity/liste.html.twig', [
            'livres'=> $livres
        ]);
    }


}
