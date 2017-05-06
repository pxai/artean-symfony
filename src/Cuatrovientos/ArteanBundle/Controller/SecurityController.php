<?php
namespace Cuatrovientos\ArteanBundle\Controller;

use Cuatrovientos\ArteanBundle\Form\Type\ChangePasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Cuatrovientos\ArteanBundle\Entity\User;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\ChangePassword;
use Cuatrovientos\ArteanBundle\Form\Type\UserProfileType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantSignInType;

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
        $formChangePassword = $this->createForm(ChangePasswordType::class, new ChangePassword());
        return $this->render('CuatrovientosArteanBundle:Security:profile.html.twig', array('formProfile'=> $form->createView(), 'formChangePassword'=>$formChangePassword->createView(),'user' => $user));
    }

    public function changePasswordAction (Request $request)
    {

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $formChange = $this->createForm(ChangePasswordType::class, new ChangePassword());

        $formChange->handleRequest($request);
        $changePassword = $formChange->getData();

        if ($formChange->isSubmitted() && $formChange->isValid()) {
            $this->get("cuatrovientos_artean.bo.security")->updatePassword($user, $changePassword);
            $this->addFlash('notice',
                            'Contraseña modificada con éxito');
        } else {
            $this->addFlash('error',
                'Error al modificar contraseña');
        }
        $form = $this->createForm(UserProfileType::class, $user);
        return $this->render('CuatrovientosArteanBundle:Security:profile.html.twig', array('formProfile'=> $form->createView(), 'formChangePassword'=>$formChange->createView(),'user' => $user));

    }

    public function forgotPasswordAction ()
    {
        $form = $this->createForm(ApplicantSignInType::class);
        return $this->render('CuatrovientosArteanBundle:Security:forgotPassword.html.twig', array('form'=> $form->createView()));
    }


    public function forgotPasswordSaveAction (Request $request)
    {
        $logger = $this->get('logger');
        $logger->info('Yeah, it works??');
        $form = $this->createForm(ApplicantSignInType::class, new Applicant());
        $logger->info('Yeah, it works');
        $form->handleRequest($request);
        $logger->info('Yeah, it works or not');
        $changePassword = $form->getData();
        $logger->info('Yeah, it works, oh si');
        if ($form->isSubmitted() && $form->isValid()) {
            // perform some action,
            // such as encoding with MessageDigestPasswordEncoder and persist
           // $this->get("cuatrovientos_artean.bo.security")->updatePassword($user, $changePassword);
            $this->addFlash('notice',
                'Contraseña modificada con éxito');
        } else {
            $this->addFlash('error',
                'Error al modificar contraseña');
        }

        return $this->render('CuatrovientosArteanBundle:Security:forgotPasswordSave.html.twig', array());

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
