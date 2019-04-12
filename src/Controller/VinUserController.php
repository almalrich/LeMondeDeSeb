<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 10/04/2019
 * Time: 16:00
 */

namespace App\Controller;

use App\Entity\Vin;

use App\Repository\VinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VinUserController extends AbstractController
{

    /**
    * @Route("/bouteille/{id}", name="bouteille", methods={"GET"})
    */
    public function affiche (Request $request, Vin $vin, $id){

        $repoVin = $this->getDoctrine()->getRepository(Vin::class);
        $vin = $repoVin->find($id);



        return $this->render('vin/uservin.html.twig', ["vins"=>$vin]);
    }
    /**
     * @Route("/uservin", name="baseUser", methods={"GET"})
     */
    public function index(VinRepository $vinRepository): Response
    {
        return $this->render('baseUser.html.twig', [
            'vins' => $vinRepository->findAll(),
        ]);
    }

    /**
     * @Route("/rouge" , name="vin_rouge")
     *
     */
    public function voirRouge(){
        $repovin = $this->getDoctrine()->getRepository(Vin::class);
        $vin = $repovin->findBy(['color'=>'rouge']);
        return $this->render('vin/rouge.html.twig', ['vins'=>$vin]);
    }

    /**
     * @Route("/rose" , name="vin_rose")
     *
     */
    public function voirRose(){
        $repovin = $this->getDoctrine()->getRepository(Vin::class);
        $vin = $repovin->findBy(['color'=>'rose']);
        return $this->render('vin/rose.html.twig', ['vins'=>$vin]);
    }

    /**
     * @Route("/blanc" , name="vin_blanc")
     *
     */
    public function voirBlanc(){
        $repovin = $this->getDoctrine()->getRepository(Vin::class);
        $vin = $repovin->findBy(['color'=>'blanc']);
        return $this->render('vin/blanc.html.twig', ['vins'=>$vin]);
    }


}

