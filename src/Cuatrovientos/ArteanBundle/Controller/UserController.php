<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\User;
use Cuatrovientos\ArteanBundle\Entity\Session;
use Cuatrovientos\ArteanBundle\Entity\UserRole;
use Cuatrovientos\ArteanBundle\Entity\ApplicantStudies;
use Cuatrovientos\ArteanBundle\Form\Type\UserSignInType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantSignUpType;

class UserController extends Controller
{
    
    var $sessionkey;
    
    /**
    *
    *
    */
    public function indexAction()
    {
        //$applicants = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->findAll();
        //$applicants = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->findApplicant();
        $form = $this->createForm(ApplicantSignInType::class);
        return $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
    }  
    
    /**
    *
    *
    */
   public function userSignInAction(Request $request,$error='',$lastUsername='')
    {

        $form = $this->createForm(UserSignInType::class);
        //$authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        //$error = $authenticationUtils->getLastAuthenticationError();
        //$lastUsername = $authenticationUtils->getLastUsername();
         
        return $this->render('CuatrovientosArteanBundle:User:signIn.html.twig', array('login' => $lastUsername,
                                                                                     'error' => $error,'form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function userSignInSaveAction(Request $request)
    {
        //$form = $this->createForm(new ApplicantType(), new Applicant());
        //$request->get('position')->set($request->request->get('company') .', '. $request->request->get('position'));    
        $form = $this->createForm(UserSignInType::class, new User());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $new_user = $form->getData();

                //$applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->findApplicant($new_applicant->getEmail());
                $user = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:User")->checkLogin($new_user);
                
                if ( null != $user) {
                    //$response =  $this->render('CuatrovientosArteanBundle:User:signInSave.html.twig', array('email' => $new_applicant->getEmail(),'msg'=>'Ya existe'));                               
                    $this->newSession($user);
                   // return $this->userSignInAction($request,'Login CORRECT');
                    //echo 'Yeah madafaka';exit;
                    return $this->redirect('https://artean.cuatrovientos.org/?login&ac=login_direct&userid='.$user->getId().'&token='.$this->sessionkey);
                } else {
                    //$form = $this->createForm(ApplicantSignUpType::class, $new_applicant);
                    //$response = $this->render('CuatrovientosArteanBundle:User:signUp.html.twig', array('form'=> $form->createView()));
                   return $this->userSignInAction($request,'Login incorrect');
                }
               /* $em = $this->getDoctrine()->getEntityManager();
                $em->merge($applicant);
                $em->flush();
                $this->sendEmail($applicant);*/
            } else {
                $response = $this->render('CuatrovientosArteanBundle:User:signIn.html.twig', array('form'=> $form->createView(),'error'=>''));
            }
        }

        return $response;
    }

    
     public function applicantSignUpSaveAction(Request $request)
    {
        //$form = $this->createForm(new ApplicantType(), new Applicant());
        //$request->get('position')->set($request->request->get('company') .', '. $request->request->get('position'));    
        $form = $this->createForm(ApplicantSignUpType::class, new Applicant());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $applicant = $form->getData();
                $user = new User();
                
                $user->setFullname($applicant->getName() .' '.$applicant->getSurname());
                $user->setLogin($applicant->getEmail());
                $user->setEmail($applicant->getEmail());
                $password = $user->randPassword();
                $user->setPassword($password);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();
                
                $applicant->setIdUser($user->getId());
                
                $em->persist($applicant);
                $em->flush();
                
                $this->saveStudies($applicant);
                $this->createProfile($user->getId());
                $this->newsession($user);
                
                $this->sendEmail($applicant);
                $this->sendEmailUser($user,$password);
                
                //return $this->redirect('https://artean.cuatrovientos.org/?home', 301);
                
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signUpSave.html.twig', array('applicant'=> $applicant, 'user'=> $user, 'password' => $password));
                
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }
    
    
    private function createProfile ($iduser) {
                $em = $this->getDoctrine()->getEntityManager();
                $userRole1 = new UserRole();
                
                $userRole1->setIduser($iduser);
                $userRole1->setIdrole(19);
                
                $userRole2 = new UserRole();
                
                $userRole2->setIduser($iduser);
                $userRole2->setIdrole(1);
                $em->persist($userRole2);

                $userRole3 = new UserRole();
                
                $userRole3->setIduser($iduser);
                $userRole3->setIdrole(2);
                $em->persist($userRole3);
                
                $em->persist($userRole1);
                $em->persist($userRole2);
                $em->persist($userRole3);

                $em->flush();
        }
    
    
        private function saveStudies ($applicant) {
                $em = $this->getDoctrine()->getEntityManager();
                $descriptions = array(9 => 'CM Comercio', 
                                      10 => 'CM Gestión Administrativa',
                                      144 => 'CM Sistemas Microinformáticos y Redes',
                                      143 => 'FP Básica',
                                      13 => 'CS Administración y Finanzas',
                                      19 => 'CS Transporte y Logística',
                                      16 => 'CS Comercio Internacional',
                                      18 => 'CS GVEC',
                                      15 => 'CS Redes y Sistemas',
                                      17 => 'CS Desarrollo de Aplicaciones Multiplataforma');
                
                foreach ($applicant->getStudies() as $k => $study) {
                    $applicantStudies = new ApplicantStudies();
                    $applicantStudies->setIdapplicant($applicant->getId());
                    $applicantStudies->setIdcenter(1);
                    $applicantStudies->setEndyear(date('Y'));
                    $applicantStudies->setIdstudies($study);
                    $applicantStudies->setDescription($descriptions[$study]);
                        $em->persist($applicantStudies);
                }
               
                $em->flush();
    }
    
    
        /**
         * Start new session
         * @param type $user
         */
    	private function newSession ($user)
	{
            //session_start();
            $sess = new Session();
            
            $sess->setUserid($user->getId());
            
	
            $secureid = "";

            $secureid = $_SERVER['HTTP_USER_AGENT'] . ":";
	    $secureid .= $_SERVER['REMOTE_ADDR'] . ":";
		
	    $sessionkey = $this->genpass(16);
            $this->sessionkey = $sessionkey;
            $sess->setSesskey($sessionkey);
            $sess->setActive(1);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($sess);
            $em->flush();

            $secureid .= $sessionkey;
	    $secureid = md5($secureid);

    	    // Crear nueva sesión borrando la anterior
	    //session_regenerate_id(true);
    	   
           // 
	   // $this->db->db_query("new_session",$user->userid,$sessionkey);	
            
	    $roles = array(1,2,19);
			

	    $_SESSION["userid"] = $user->getId();
            $_SESSION["key"] = $secureid;
            $_SESSION["login"] = $user->getLogin();
	    $_SESSION["roles"] = $roles; 
	    $_SESSION["lopd"] = 0; 
            
//            print_r($_SESSION);
//            print_r($user);
	}
        
        	/**
	* genpass
	* Genera un password
	*/
	public function genpass ($len=8)
	{
		$caracteres = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789.,-_";
		$tot = strlen($caracteres);
		
		$result = "";
		
		for ($i=0;$i<$len;$i++)
		{
			$result .= $caracteres[rand(0,$tot-1)];
		}
		
		return $result;
	}
        
    private function sendEmail ($applicant) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡nuevo candidato en la bolsa de empleo!')
        ->setFrom('artean@cuatrovientos.org')
        ->setTo('artean@cuatrovientos.org')
        ->setBcc('pello_altadill@cuatrovientos.org')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/newApplicant.html.twig',
                array('applicant' => $applicant)
            ),
            'text/html'
        );

        $this->get('mailer')->send($message);

    }
    
    
        private function sendEmailUser ($user, $password) {
         $message = \Swift_Message::newInstance()
        ->setSubject('Artean: ¡Bienvenid@ la bolsa de empleo!')
        ->setFrom('artean@cuatrovientos.org')
        ->setTo($user->getEmail())
        ->setBcc('pello_altadill@cuatrovientos.org')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/newUser.html.twig',
                array('user' => $user, 'password' => $password)
            ),
            'text/html'
        );

        $this->get('mailer')->send($message);

    }
    /**
    *
    *
    */
   public function applicantDetailAction($id=1)
    {

        $applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->find($id);
   
        return $this->render('CuatrovientosArteanBundle:Applicant:detail.html.twig',array('applicant'=> $applicant));
    }

    /**
    *
    *
    */
    public function applicantUpdateAction($id) {
        $applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->find($id);
      
        $form = $this->createForm(ApplicantType::class, $applicant);

        return $this->render('CuatrovientosArteanBundle:Applicant:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function applicantUpdateSaveAction(Request $request) {
      
        $form = $this->createForm(ApplicantType::class, new Applicant());
      //  $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicant = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($applicant);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('CuatrovientosArteanBundle:Applicant:applicantDetail', array('id' => $applicant->getId()));
            } else  {
                 $response = $this->render('CuatrovientosArteanBundle:Applicant:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    /**
    *
    *
    */
   public function applicantDeleteAction($id=1)
    {
        $applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->find($id);
        return $this->render('CuatrovientosArteanBundle:Applicant:delete.html.twig',array('applicant'=> $applicant));
    }

    /**
    *
    *
    */
   public function applicantDeleteSaveAction(Applicant $applicant)
    {

       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($applicant);
       $em->flush();
       return $this->forward('CuatrovientosArteanBundle:Applicant:index');
    }

}
