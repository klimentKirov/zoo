<?php

namespace App\Controller;

use App\Entity\Cage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/get_animal_action", name="animal_action", methods={"GET"})
     */
    public function get_animal_action(Request $request)
    {
        $cageId = $request->query->get('cage');
        $cageObj = $this->getDoctrine()->getRepository(Cage::class)->find($cageId);
        $animalAction = $cageObj->getAnimal()->makeAction();

        return $this->json(['response'=>$animalAction]);
    }

    /**
     * @Route("/api/feed_animal", name="feed_animal", methods={"GET"})
     */
    public function feed_animal(Request $request)
    {
        $cageId = $request->query->get('cage');
        $cageObj = $this->getDoctrine()->getRepository(Cage::class)->find($cageId);
        $animalAction = $cageObj->getAnimal()->eat();

        return $this->json(['response'=>$animalAction]);
    }

    /**
     * @Route("/api/clear_cage", name="clear_cage", methods={"GET"})
     */
    public function clear_cage(Request $request)
    {
        $cageId = $request->query->get('cage');
        $result = $this->getDoctrine()->getRepository(Cage::class)->find($cageId)->clear();

        return $this->json(['response'=>$result]);
    }
}
