<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 09/04/2019
 * Time: 15:59
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class securityController extends AbstractController
{
    /*authentication by username */
    /**
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @Route("/login", name="login")
     * @return mixed
     */
    public function login (Request $request, AuthenticationUtils $authenticationUtils){

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastusername = $authenticationUtils->getLastUsername();

        return $this->render("security/login.html.twig",
            ["error"=>$error,
                "lastusername"=>$lastusername]);
    }}
