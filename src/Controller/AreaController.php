<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AreaController extends Controller
{
    /**
     * @Route("/area", name="area_index")
     */
    public function index()
    {
        return $this->render('area/index.html.twig', [
            'controller_name' => 'AreaController',
        ]);
    }

    /**
     * @Route("/admin/secure/info", name="area_admin_info")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function admin_info()
    {
        return $this->render('area/admin_info.html.twig', [
            '' => '',
        ]);
    }

    /**
     * @Route("/modo/info", name="area_modo_info")
     */
    public function modo_info()
    {
        $this->denyAccessUnlessGranted('ROLE_MODO'); //autre façon d'interdire l'accés
        return $this->render('area/modo_info.html.twig', [
            '' => '',
        ]);
    }

    /**
     * @Route("/user/info", name="area_user_info")
     */
    public function user_info()
    {
        return $this->render('area/user_info.html.twig', [
            '' => '',
        ]);
    }

}
