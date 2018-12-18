<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        // creating login userform
        $newLogin = new User();
        $form = $this->createForm(LoginType::class, $newLogin, [
            'action' => $this -> generateUrl('login'),
            'method' => 'POST'
        ]);
        $form->handleRequest($request);

        return $this->render('BackEnd/login.html.twig',[
            'form'=>$form->createView(),
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
}