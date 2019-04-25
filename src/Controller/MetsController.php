<?php

namespace App\Controller;

use App\Entity\Mets;
use App\Form\MetsType;
use App\Repository\MetsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mets")
 */
class MetsController extends AbstractController
{
    /**
     * @Route("/", name="mets_index", methods={"GET"})
     */
    public function index(MetsRepository $metsRepository): Response
    {
        return $this->render('mets/index.html.twig', [
            'mets' => $metsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mets_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $met = new Mets();
        $form = $this->createForm(MetsType::class, $met);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($met);
            $entityManager->flush();

            return $this->redirectToRoute('mets_index');
        }

        return $this->render('mets/new.html.twig', [
            'met' => $met,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mets_show", methods={"GET"})
     */
    public function show(Mets $met): Response
    {
        return $this->render('mets/show.html.twig', [
            'met' => $met,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mets $met): Response
    {
        $form = $this->createForm(MetsType::class, $met);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            /*
            return $this->redirectToRoute('mets_index', [
                'id' => $met->getId(),
            ]);*/
        }

        return $this->render('mets/edit.html.twig', [
            'mets' => $met,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="mets_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mets $met): Response
    {
        if ($this->isCsrfTokenValid('delete'.$met->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($met);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mets_index');
    }


}

