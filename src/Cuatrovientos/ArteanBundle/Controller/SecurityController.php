<?php
namespace Cuatrovientos\ArteanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ApiBundle\Entity\User;
use ApiBundle\Form\Type\UserSignInType;

class SecurityController extends Controller
{
     /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'CuatrovientosArteanBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error
            )
        );
    }



    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }

    /**
     *
     * @Route("/profile", name="profile")
     */
    public function profileAction (Request $request)
    {
        $user = new User();
        $user->setUsername('Test');
        $response =  $this->render('CuatrovientosArteanBundle:Security:profile.html.twig', array('user' => $user));
    }


    /**
     * @Route("/artean/redirect", name="artean_redirect")
     */
    public function arteanRedirectAction()
    {
        //$this->get('session')->set('loginUserId', $user['user_id']);
        //return $this->redirect("/artean/arteans/admin/workorders");

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
           return  $this->render('CuatrovientosArteanBundle:Default:adminDashboard.html.twig');
        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
            return $this->redirectToRoute("cuatrovientos_artean_workorder");
        }
    }


}
