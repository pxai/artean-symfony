<?php

namespace  Cuatrovientos\ArteanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cuatrovientos\ArteanBundle\Entity\Applicant;
use Cuatrovientos\ArteanBundle\Entity\User;
use Cuatrovientos\ArteanBundle\Entity\Session;
use Cuatrovientos\ArteanBundle\Entity\UserRole;
use Cuatrovientos\ArteanBundle\Entity\ApplicantStudies;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantSignInType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantSignUpType;
use Cuatrovientos\ArteanBundle\Entity\ApplicantJobs;
use Cuatrovientos\ArteanBundle\Entity\ApplicantLanguages;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantStudiesType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantLanguageType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantJobType;

class ApplicantAdminController extends Controller
{

    public function indexAction($init=0,$limit=100)
    {
        $form = $this->createForm(ApplicantType::class);
        $applicants = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicants(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.applicant")->countAllApplicants();

        return $this->render('CuatrovientosArteanBundle:Applicant:indexAdmin.html.twig', array('applicants'=>$applicants, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView()));
    }


    public function detailAction($id)
    {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);

        $form = $this->createForm(ApplicantType::class, $applicant);
        $formStudies = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());
        $formLanguage = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());
        $formJob = $this->createForm(ApplicantJobType::class, new ApplicantJobs());
        return $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig',
            array(  'form'=> $form->createView(),
                'formStudies'=>$formStudies->createView(),
                'formLanguage'=>$formLanguage->createView(),
                'formJob'=>$formJob->createView(),
                'applicant'=>$applicant));
    }

    public function updateAction(Request $request) {
        $form = $this->createForm(ApplicantType::class, new Applicant());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicant = $form->getData();
                $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);

                return $this->detailAction($applicant->getId());
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }


    public function newStudiesAction(Request $request) {

        $form = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantStudies = $form->getData();
                $this->get("cuatrovientos_artean.bo.applicant")->saveApplicantStudies($applicantStudies);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function deleteStudiesAction($id) {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $applicantStudies= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantStudies($id, $applicant);
        if (null !=  $applicantStudies) {
            $this->get("cuatrovientos_artean.bo.applicant")->deleteApplicantStudies($applicantStudies);
        }
        return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');

    }

    public function updateStudiesAction($id) {

        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $applicantStudies= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantStudies($id, $applicant);
        $applicantStudies->getCenter();
        $applicantStudies->getStudies();
        if (null !=  $applicantStudies) {
            $formStudies = $this->createForm(ApplicantStudiesType::class, $applicantStudies);
            return $this->render('CuatrovientosArteanBundle:Applicant/Studies:update.html.twig', array('formStudies' => $formStudies->createView(),'applicantStudies'=>$applicantStudies));
        } else {
            return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
        }
    }

    public function updateStudiesSaveAction(Request $request) {
        $id  = $request->get("id");
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $form = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantStudies = $form->getData();
                $applicantStudies->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->updateApplicantStudies($applicantStudies);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function newLanguageAction(Request $request) {
        $id  = $request->get("id");

        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $form = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantLanguages = $form->getData();
                $applicantLanguages->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->saveApplicantLanguages($applicantLanguages);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function updateLanguageAction($id) {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $applicantLanguages= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantLanguages($id, $applicant);

        if (null !=  $applicantLanguages) {
            $formLanguage = $this->createForm(ApplicantLanguageType::class, $applicantLanguages);
            return $this->render('CuatrovientosArteanBundle:Applicant/Languages:update.html.twig', array('formLanguage' => $formLanguage->createView()));
        } else {
            return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
        }
    }

    public function updateLanguageSaveAction(Request $request) {
        $id  = $request->get("id");

        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $form = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantLanguages = $form->getData();
                $applicantLanguages->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->updateApplicantLanguages($applicantLanguages);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function deleteLanguageAction($id) {
        $id  = 0;
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $applicantLanguages= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantLanguages($id, $applicant);
        if (null !=  $applicantLanguages) {
            $this->get("cuatrovientos_artean.bo.applicant")->deleteApplicantLanguages($applicantLanguages);
        }
        return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
    }

    public function newJobAction(Request $request) {
        $id  = $request->get("id");

        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $form = $this->createForm(ApplicantJobType::class, new ApplicantJobs());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantJob = $form->getData();
                $applicantJob ->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->saveApplicantJobs($applicantJob);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function updateJobAction($id) {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $applicantJob= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantJobs($id, $applicant);
        $applicantJob->getCompany();

        if (null !=  $applicantJob) {
            $formJob = $this->createForm(ApplicantJobType::class, $applicantJob);
            return $this->render('CuatrovientosArteanBundle:Applicant/Jobs:update.html.twig', array('formJob' => $formJob->createView(),'applicantJob'=>$applicantJob));
        } else {
            return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
        }
    }

    public function updateJobSaveAction(Request $request) {
        $id  = $request->get("id");
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $form = $this->createForm(ApplicantJobType::class, new ApplicantJobs());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantJob = $form->getData();
                $applicantJob->setApplicant($applicant);
                $this->get("cuatrovientos_artean.bo.applicant")->updateApplicantJobs($applicantJob);

                return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function deleteJobAction($id) {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);
        $applicantJobs= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantJobs($id, $applicant);
        if (null !=  $applicantJobs) {
            $this->get("cuatrovientos_artean.bo.applicant")->deleteApplicantJobs($applicantJobs);
        }
        return $this->forward('CuatrovientosArteanBundle:Applicant:dashboard');
    }

   public function applicantSignInAction()
    {
        $form = $this->createForm(ApplicantSignInType::class);
        return $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
    }


    public function applicantSignInSaveAction(Request $request)
    {
        //$form = $this->createForm(new ApplicantType(), new Applicant());
        //$request->get('position')->set($request->request->get('company') .', '. $request->request->get('position'));    
        $form = $this->createForm(ApplicantSignInType::class, new Applicant());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            
            //$form->submit($request->request->get($form->getName()));
            
            if ($form->isValid()) {
                $new_applicant = $form->getData();
                $applicant = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:Applicant")->findApplicant($new_applicant->getEmail());
                $user = $this->getDoctrine()->getRepository("CuatrovientosArteanBundle:User")->findUser($new_applicant->getEmail());
                
                if (null != $applicant || null != $user) {
                    $response =  $this->render('CuatrovientosArteanBundle:Applicant:signInSave.html.twig', array('email' => $new_applicant->getEmail(),'msg'=>'Ya existe'));                               
                } else {
                    $form = $this->createForm(ApplicantSignUpType::class, $new_applicant);
                    $response = $this->render('CuatrovientosArteanBundle:Applicant:signUp.html.twig', array('form'=> $form->createView()));
                }
               /* $em = $this->getDoctrine()->getEntityManager();
                $em->merge($applicant);
                $em->flush();
                $this->sendEmail($applicant);*/
            } else {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
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
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signUp.html.twig', array('form'=> $form->createView()));
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
    	private function newsession ($user)
	{
            session_start();
            $sess = new Session();
            
            $sess->setUserid($user->getId());
            
	
            $secureid = "";

            $secureid = $_SERVER['HTTP_USER_AGENT'] . ":";
	    $secureid .= $_SERVER['REMOTE_ADDR'] . ":";
		
	    $sessionkey = $this->genpass(16);
            $sess->setSesskey($sessionkey);
            $sess->setActive(1);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($sess);
            $em->flush();

            $secureid .= $sessionkey;
	    $secureid = md5($secureid);

    	    // Crear nueva sesión borrando la anterior
	    session_regenerate_id(true);
    	   
           // 
	   // $this->db->db_query("new_session",$user->userid,$sessionkey);	
            
	    $roles = array(1,2,19);
			

	    $_SESSION["userid"] = $user->getId();
            $_SESSION["key"] = $secureid;
            $_SESSION["login"] = $user->getLogin();
	    $_SESSION["roles"] = $roles; 
	    $_SESSION["lopd"] = 0; 
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
			$result .= $caracteres[rand(0,$tot)];
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

}
