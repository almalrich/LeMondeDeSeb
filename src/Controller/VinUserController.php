<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 10/04/2019
 * Time: 16:00
 */

namespace App\Controller;


use App\Entity\Vin;
use App\Entity\Mets;

use App\Repository\MetsRepository;
use App\Repository\VinRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityRepository;


class VinUserController extends AbstractController
{
/*show botlle by Id*/
    /**
     *
     * @Route("/vin/bout/{id}" , name="bout")
     *
     */
    public function montrebout($id){


        $repobout = $this->getDoctrine()->getRepository(Vin::class);
        $bout = $repobout->find($id);
        $test = $bout->getMets();




        return $this->render('vin/bout.html.twig',['bout'=>$bout,
            "mets"=>$bout->getMets()]);
    }


    /*select all wine in Vin table*/
    /**
     * @Route("/uservin", name="baseUser", methods={"GET"})
     */
    public function index(VinRepository $vinRepository): Response
    {
        return $this->render('baseUser.html.twig', [
            'vins' => $vinRepository->findAll(),
        ]);
    }
    /*DQL Request for red wine by "appellation"*/
    /**
     * @Route("bout/rouge" , name="vin_rouge")
     *
     */
    public function voirRouge()
    {

        $er = $this->getDoctrine()->getRepository(Vin::class);

        $form = $this->createFormBuilder()
            ->add('vin', EntityType::class, ['class' => Vin::class,
                'query_builder' => function (EntityRepository $er)  {
                    return $er->createQueryBuilder('u')
                        ->select('u')
                        ->distinct(true)
                        ->groupBy('u.appelation')
                        ->andWhere("u.color = 'rouge' ");

                },
                'choice_label' => 'appelation',
            ])
            ->getForm();


        return $this->render('vin/rouge.html.twig', ['wine' => $form->createView()]);

    }



    /*show DQL's botlle by "Appellation"*/

    /**
     *@Route("/rouge/{appelation}", name="vinId")
     *
     *
     */
    public function afficheRouge($appelation){


        $repoVin = $this->getDoctrine()->getRepository(Vin::class);
        $vins = $repoVin->findBy(["appelation"=>$appelation, 'color'=>'rouge']);

        return $this->render('vin/wine.html.twig', ['vins'=>$vins]);




    }

    /* The same for pink*/

    /**
     * @Route("bout/rose" , name="vin_rose")
     *
     */
    public function voirRose()
    {
        $er = $this->getDoctrine()->getRepository(Vin::class);
        $form = $this->createFormBuilder()
            ->add('vin', EntityType::class, ['class' => Vin::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->select('u')
                        ->distinct(true)
                        ->groupBy('u.appelation')
                        ->andWhere("u.color = 'rose' ");
                },
                'choice_label' => 'appelation',
            ])
            ->getForm();
        return $this->render('vin/rose.html.twig', ['wine' => $form->createView()]);
    }

    /**
     *@Route("/rose/{appelation}", name="vinIdrose")
     *
     */
    public function afficheRose($appelation)
    {

        $repoVin = $this->getDoctrine()->getRepository(Vin::class);
        $vins = $repoVin->findBy(["appelation" => $appelation, 'color'=>'rose']);
        return $this->render('vin/pink.html.twig', ['vins' => $vins]);

    }

    /*the same for withe wine*/
    /**
     * @Route("bout/blanc" , name="vin_blanc")
     *
     */
    public function voirBlanc()
    {
        $er = $this->getDoctrine()->getRepository(Vin::class);
        $form = $this->createFormBuilder()
            ->add('vin', EntityType::class, ['class' => Vin::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                        ->select('b')
                        ->distinct(true)
                        ->groupBy('b.appelation')
                        ->andWhere("b.color = 'blanc' ");
                },
                'choice_label' => 'appelation',
            ])
            ->getForm();

        return $this->render('vin/blanc.html.twig', ['wine' => $form->createView()]);
    }
    /**
     *@Route("/blanc/{appelation}", name="vinIdBlc")
     *
     */
    public function afficheBlanc($appelation)
    {

        $repoVin = $this->getDoctrine()->getRepository(Vin::class);
        $vins = $repoVin->findBy(["appelation" => $appelation, 'color'=>'blanc']);
        return $this->render('vin/white.html.twig', ['vins' => $vins]);

    }





    /* And last for pet wine*/
    /**
     * @Route("bout/petillant" , name="vin_petillant")
     *
     */
    public function voirPet()
    {
        $er = $this->getDoctrine()->getRepository(Vin::class);
        $form = $this->createFormBuilder()
            ->add('vin', EntityType::class, ['class' => Vin::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere("u.color = 'petillant' ")
                        ->select('u')
                        ->distinct(true)
                        ->groupBy('u.appelation');

                },
                'choice_label' => 'appelation',
            ])
            ->getForm();

        return $this->render('vin/pet.html.twig', ['wine' => $form->createView()]);
    }

    /**
     *@Route("/petillant/{appelation}", name="vinIdPet")
     *
     */
    public function affichePet($appelation)
    {

        $repoVin = $this->getDoctrine()->getRepository(Vin::class);
        $vins = $repoVin->findBy(["appelation" => $appelation, 'color'=>'petillant']);
        return $this->render('vin/vin_petillant.html.twig', ['vins' => $vins]);

    }

}

