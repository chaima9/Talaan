<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="sign_in")
     */
    public function login(Request $request, AuthenticationUtils $utils): Response

    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN_F')) {
                return $this->redirectToRoute('admin');
            } else if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN_C')) {
                return $this->redirectToRoute('admin');
            }else if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN_V')) {
                return $this->redirectToRoute('admin');
            }
            else {
                return $this->redirectToRoute('admin');
            }
        }

        $user=$this->getUser();

        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
        return $this->render('front/sign_in.html.twig', [
            'error' => $error,  'user' => $user,
            'last_username' => $lastUsername,


        ]);

    }
    /**
     * @Route("/sign_in2", name="sign_in2")
     */
    public function login2(Request $request, AuthenticationUtils $utils): Response

    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('home');


            }

        }


        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
        return $this->render('back/sign_up2.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,


        ]);

    }


    /**
     * @Route("/front/logout", name="logout")
     */
    public function logout()
    {
    


    }
}
