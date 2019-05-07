<?php

namespace App\Controller;

use App\Entity\Vin;
use App\Entity\Mets;
use App\Form\VinType;
use App\Repository\VinRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vin")
 */
class VinController extends AbstractController
{
    /**
     * @Route("/vin_index", name="vin_index", methods={"GET"})
     */
    public function index(VinRepository $vinRepository): Response
    {
        return $this->render('vin/index.html.twig', [
            'vins' => $vinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vin = new Vin();

        $form = $this->createForm(VinType::class, $vin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mets = $vin->getMets();
            $val = $mets->count();

            for($i=0; $i<$val; $i++)
            {
                $mets->get($i)->addVin($vin);
            }



            $entityManager = $this->getDoctrine()->getManager();




            $entityManager->persist($vin);
            $entityManager->flush();

            return $this->redirectToRoute('vin_index');
        }

        return $this->render('vin/new.html.twig', [
            'vin' => $vin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vin_show", methods={"GET"})
     */
    public function show(Vin $vin): Response
    {
        return $this->render('vin/show.html.twig', [
            'vin' => $vin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vin $vin): Response
    {



        //$session = new Session();



        $form = $this->createForm(VinType::class, $vin);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $mets = $vin->getMets();
            $mets = $mets->toArray();
            $arr = array();
            foreach($mets as $met)
            {
                $arr[] = $met->getId();
                $met->addVin($vin);
            }
            $arrI = implode(",",$arr);


            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->executeQuery('delete from mets_vin where vin_id ='.$vin->getId().' and mets_id NOT IN ('.$arrI.')');
            $em->flush();

            return $this->redirectToRoute('vin_index', [
                'id' => $vin->getId(),
            ]);
        }
        else
        {

            //$vin->removeMets();
            //$this->getDoctrine()->getManager()->flush();

            //$session->set('VinP',$vin);


            /*
            $mets = $vin->getMets();
            $val = $mets->count();
            for($i=0; $i<$val; $i++)
            {
                $vin->removeMet();
            }*/

            //dd($mets);
        }

        return $this->render('vin/edit.html.twig', [
            'vin' => $vin,
            'form' => $form->createView(),

               ]);
    }

    /**
     * @Route("/{id}/delete", name="vin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vin $vin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vin_index');
    }



}
