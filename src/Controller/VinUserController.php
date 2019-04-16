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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VinUserController extends AbstractController
{

    /**
     * @Route("/bouteille/{id}", name="bouteille", methods={"GET"})
     */
    public function affiche(Request $request, Vin $vin, $id)
    {

        $repoVin = $this->getDoctrine()->getRepository(Vin::class);
        $vin = $repoVin->find($id);


        return $this->render('vin/uservin.html.twig', ["vins" => $vin]);
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
    public function voirRouge()
    {
        // SELECT DISTINCT vin.appelation FROM vin ORDER BY appelation

        $form = $this->createFormBuilder()
            ->add('vin', EntityType::class, ['class' => Vin::class,
                'query_builder' => function (VinRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->distinct('u.appelation')
                        ->andWhere("u.color = 'rouge' ");

                },
                'choice_label' => 'appelation',
            ])
            ->getForm();






        return $this->render('vin/rouge.html.twig', ['wine' => $form->createView()]);

    }

    /**
     *@Route("/rouge/{IdVin}", name="IdVin")
     *
     */

    public function afficheRouge($IdVin){

        $repoVin = $this->getDoctrine()->getRepository(Vin::class);
        $vins = $repoVin->find($IdVin);

        $response = new JsonResponse();
        $response->setData($vins);

        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }
    /**
     * @Route("/rose" , name="vin_rose")
     *
     */
    public function voirRose()
    {
        $form = $this->createFormBuilder()
            ->add('vin', EntityType::class, ['class' => Vin::class,
                'query_builder' => function (VinRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere("u.color = 'rose' ");
                },
                'choice_label' => 'name',
            ])
            ->getForm();
        return $this->render('vin/rose.html.twig', ['wine' => $form->createView()]);
    }

    /**
     * @Route("/blanc" , name="vin_blanc")
     *
     */
    public function voirBlanc()
    {
        $form = $this->createFormBuilder()
            ->add('vin', EntityType::class, ['class' => Vin::class,
                'query_builder' => function (VinRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere("u.color = 'blanc' ");
                },
                'choice_label' => 'name',
            ])
            ->getForm();

        return $this->render('vin/blanc.html.twig', ['wine' => $form->createView()]);
    }

    /**
     * @Route("/pet" , name="vin_petillant")
     *
     */
    public function voirPet()
    {
        $form = $this->createFormBuilder()
            ->add('vin', EntityType::class, ['class' => Vin::class,
                'query_builder' => function (VinRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere("u.color = 'petillant' ");
                },
                'choice_label' => 'name',
            ])
            ->getForm();

        return $this->render('vin/pet.html.twig', ['wine' => $form->createView()]);
    }


}

