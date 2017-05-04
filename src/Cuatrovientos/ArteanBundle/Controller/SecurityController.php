<?php
namespace Cuatrovientos\ArteanBundle\Controller;

use Cuatrovientos\ArteanBundle\Form\Type\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Cuatrovientos\ArteanBundle\Entity\User;
use Cuatrovientos\ArteanBundle\Entity\ChangePassword;
use Cuatrovientos\ArteanBundle\Form\Type\UserProfileType;

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
    public function profileAction ()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(UserProfileType::class, $user);
        $formChange = $this->createForm(ChangePasswordType::class);
        return $this->render('CuatrovientosArteanBundle:Security:profile.html.twig', array('formProfile'=> $form->createView(), 'formChangePassword'=>$formChange->createView(),'user' => $user));
    }

    public function changePasswordAction (Request $request)
    {
        $formChange = $this->createForm(new ChangePasswordType(), new ChangePassword());

        $formChange->handleRequest($request);

        if ($formChange->isSubmitted() && $formChange->isValid()) {
            // perform some action,
            // such as encoding with MessageDigestPasswordEncoder and persist
            return $this->redirect($this->generateUrl('change_passwd_success'));
        } else {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $form = $this->createForm(UserProfileType::class, $user);
            return $this->render('CuatrovientosArteanBundle:Security:profile.html.twig', array('formProfile'=> $form->createView(), 'formChangePassword'=>$formChange->createView(),'user' => $user));
        }
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
        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_STUDENT')) {
            return $this->redirectToRoute("cuatrovientos_artean_workorder");
        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_USER')){
            return $this->redirectToRoute("cuatrovientos_artean_workorder");
        }
    }


}
