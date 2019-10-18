<?php

namespace App\Controller;

use App\Entity\Cage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ZooController extends AbstractController
{
    /**
     * @Route("/zoo", name="zoo")
     */
    public function index()
    {
        $cagesArr = $this->getDoctrine()->getRepository(Cage::class)->findAll();
        return $this->render('zoo/index.html.twig', [
            'controller_name' => 'ZooController',
            'cages' => $cagesArr
        ]);
    }
}
