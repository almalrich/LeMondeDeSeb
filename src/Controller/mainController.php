<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 09/04/2019
 * Time: 16:11
 */
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class mainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     */
    public function homepage(){

        if (true === $this->get("security.authorization_checker")->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute("user_index");
        }
        elseif (true === $this->get("security.authorization_checker")->isGranted('ROLE_USER')){
            return $this->redirectToRoute("vin");
        }
        else {
            return $this->redirectToRoute("login");
        }
    }


}