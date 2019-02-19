<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/{_locale}/traduction")
 */
class TraductionController extends Controller
{
    /**
     * @Route("/", name="traduction_index")
     */
    public function index($_locale, TranslatorInterface $translator)
    {
        $info = $translator->trans("information");
        return $this->render('traduction/index.html.twig', [
            'information' => $info,
            'count' => 1
        ]);
    }
}
