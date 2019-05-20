<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 09/04/2019
 * Time: 16:11
 */
namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class mainController extends AbstractController
{/* redirect by Role homepage*/
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
            return $this->redirectToRoute("baseUser");
        }
        else {
            return $this->redirectToRoute("inscription");
        }

    }
/*inscription*/
    /**
     * @Route("/inscription", name="inscription")
     *
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $user = new User();

        $form = $this->createForm(UserType::class,$user)->remove('rankId')->add('save',SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){

            $user->setRankId(2);
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);


            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('login');

        }


        return $this->render('user/inscription.html.twig', ['enregistrement'=>$form->createView()]);

}


}
