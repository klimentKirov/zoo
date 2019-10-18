<?php

namespace App\Controller;

use App\Entity\Cage;
use App\Form\CageType;
use App\Repository\CageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cage")
 */
class CageController extends AbstractController
{
    /**
     * @Route("/", name="cage_index", methods={"GET"})
     */
    public function index(CageRepository $cageRepository): Response
    {
        return $this->render('cage/index.html.twig', [
            'cages' => $cageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cage = new Cage();
        $form = $this->createForm(CageType::class, $cage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cage);
            $entityManager->flush();

            return $this->redirectToRoute('cage_index');
        }

        return $this->render('cage/new.html.twig', [
            'cage' => $cage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cage_show", methods={"GET"})
     */
    public function show(Cage $cage): Response
    {
        return $this->render('cage/show.html.twig', [
            'cage' => $cage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cage $cage): Response
    {
        $form = $this->createForm(CageType::class, $cage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cage_index');
        }

        return $this->render('cage/edit.html.twig', [
            'cage' => $cage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cage_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cage $cage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cage_index');
    }
}
