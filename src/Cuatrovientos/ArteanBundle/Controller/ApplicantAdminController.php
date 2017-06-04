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
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantAdvancedSearchType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantPhotoType;
use Cuatrovientos\ArteanBundle\Form\Type\ApplicantCvType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


class ApplicantAdminController extends Controller
{

    public function indexAction($init=0,$limit=100)
    {
        $form = $this->createForm(ApplicantType::class);
        $formSearch = $this->createForm(ApplicantAdvancedSearchType::class);
        $applicants = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicants(0, $init, $limit);
        $total = $this->get("cuatrovientos_artean.bo.applicant")->countAllApplicants();

        return $this->render('CuatrovientosArteanBundle:Applicant:indexAdmin.html.twig', array('applicants'=>$applicants, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView(),'formSearch'=> $formSearch->createView()));
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(ApplicantAdvancedSearchType::class, new Applicant());
        $formSearch = $this->createForm(ApplicantAdvancedSearchType::class);
        $init = 0;
        $limit = 100;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $applicant = $form->getData();

                $applicants = $this->get("cuatrovientos_artean.bo.applicant")->detailedSearchApplicants($applicant);
                $total = count($applicants);
                return $this->render('CuatrovientosArteanBundle:Applicant:indexAdmin.html.twig', array('applicants' => $applicants, 'init' => $init, 'limit' => $limit, 'total' => $total, 'form' => $form->createView(),'formSearch'=> $formSearch->createView()));
            }
        } else {
            $applicants = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicants(0, $init, $limit);
            $total = $this->get("cuatrovientos_artean.bo.applicant")->countAllApplicants();
            return $this->render('CuatrovientosArteanBundle:Applicant:indexAdmin.html.twig', array('applicants'=>$applicants, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView(),'formSearch'=> $formSearch->createView()));
            return $this->render('CuatrovientosArteanBundle:Applicant:indexAdmin.html.twig', array('applicants'=>$applicants, 'init'=>$init, 'limit'=> $limit, 'total'=> $total,'form'=> $form->createView(),'formSearch'=> $formSearch->createView()));
        }
    }

    public function advancedSearchAction(Request $request) {
        $form = $this->createForm(ApplicantAdvancedSearchType::class, new Applicant());
        $logger = $this->get('logger');
        $response = "";
        $applicants = array();
        $total = 0;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            // if ($form->isValid()) {
            $applicant = $form->getData();
            $applicants = $this->get("cuatrovientos_artean.bo.applicant")->detailedSearchApplicants($applicant);
            /*} else  {
                $applicants = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicants(0, 0, 10);
                $total = $this->get("cuatrovientos_artean.bo.applicant")->countAllApplicants();
                return $applicants;
            }*/
        }
        return $this->render('CuatrovientosArteanBundle:Applicant:applicantList.html.twig', array('applicants' => $applicants  ));
    }

    public function detailAction($id)
    {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);

        $form = $this->createForm(ApplicantType::class, $applicant);
        $formStudies = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());
        $formLanguage = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());
        $formJob = $this->createForm(ApplicantJobType::class, new ApplicantJobs());
        $formPhoto = $this->createForm(ApplicantPhotoType::class);
        $formCv = $this->createForm(ApplicantCvType::class);
        return $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig',
            array(  'form'=> $form->createView(),
                'formStudies'=>$formStudies->createView(),
                'formLanguage'=>$formLanguage->createView(),
                'formJob'=>$formJob->createView(),
                'formPhoto' => $formPhoto->createView(),
                'formCv' => $formCv->createView(),
                'applicant'=>$applicant));
    }

    public function resetPasswordAction($id)
    {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);

        if ($applicant) {
            $newPassword = $applicant->getPhone();
            $applicant->getUser()->setPassword($newPassword );
            $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);
            $this->addFlash('notice', 'Contraseña modificada con éxito. Usuario: '. $applicant->getUser()->getUsername().'. Password: ' . $newPassword);
        }
        return $this->detailAction($id);
    }

    public function createAccountAction($id)
    {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);

        if ($applicant) {
            $newPassword = $applicant->getPhone();
            $user = new User();
            $user->setLogin($applicant->getEmail());
            $user->setEmail($applicant->getEmail());
            $user->setPassword($newPassword );
            $user->setFullname($applicant->getName().' '.$applicant->getSurname());
            $applicant->setUser($user);
            $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);
            $this->addFlash('notice', 'Cuenta creada con éxito. Usuario: '. $applicant->getUser()->getUsername().'. Password: ' . $newPassword);
        }
            return $this->detailAction($id);
    }


    public function detailResumedAction($id)
    {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($id);

        $form = $this->createForm(ApplicantType::class, $applicant);
        $formStudies = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());
        $formLanguage = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());
        $formJob = $this->createForm(ApplicantJobType::class, new ApplicantJobs());
        return $this->render('CuatrovientosArteanBundle:Applicant:detail.html.twig',
            array(  'form'=> $form->createView(),
                'formStudies'=>$formStudies->createView(),
                'formLanguage'=>$formLanguage->createView(),
                'formJob'=>$formJob->createView(),
                'applicant'=>$applicant));
    }


    public function updateAction(Request $request) {
        $form = $this->createForm(ApplicantType::class, new Applicant());
        $response = "";
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicant = $form->getData();
                $applicantTmp = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($applicant->getId());
                $applicant->setUser($applicantTmp->getUser());
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

                return $this->detailAction($applicantStudies->getApplicant()->getId());
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function deleteStudiesAction($id) {
        $applicantStudies= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantStudiesById($id);
        if (null !=  $applicantStudies) {
            $this->get("cuatrovientos_artean.bo.applicant")->deleteApplicantStudies($applicantStudies);
        }
        return $this->detailAction($applicantStudies->getApplicant()->getId());
    }

    public function updateStudiesAction($id) {

        $applicantStudies= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantStudiesById($id);
        $applicantStudies->getCenter();
        $applicantStudies->getStudies();
        if (null !=  $applicantStudies) {
            $formStudies = $this->createForm(ApplicantStudiesType::class, $applicantStudies);
            return $this->render('CuatrovientosArteanBundle:Applicant/Studies:update.html.twig', array('formStudies' => $formStudies->createView(),'applicantStudies'=>$applicantStudies));
        } else {
            return $this->detailAction($applicantStudies->getApplicant()->getId());
        }
    }

    public function updateStudiesSaveAction(Request $request) {

        $form = $this->createForm(ApplicantStudiesType::class, new ApplicantStudies());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantStudies = $form->getData();
                $this->get("cuatrovientos_artean.bo.applicant")->updateApplicantStudies($applicantStudies);

                return $this->detailAction($applicantStudies->getApplicant()->getId());
            } else  {
                return $this->updateAction($request->get->get("id"));
            }
        }
         return $this->updateAction($request->get->get("id"));
    }

    public function newLanguageAction(Request $request) {
        $form = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantLanguages = $form->getData();
                $this->get("cuatrovientos_artean.bo.applicant")->saveApplicantLanguages($applicantLanguages);

                return $this->detailAction($applicantLanguages->getApplicant()->getId());
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function updateLanguageAction($id) {

        $applicantLanguages= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantLanguagesById($id);

        if (null !=  $applicantLanguages) {
            $formLanguage = $this->createForm(ApplicantLanguageType::class, $applicantLanguages);
            return $this->render('CuatrovientosArteanBundle:Applicant/Languages:update.html.twig', array('formLanguage' => $formLanguage->createView()));
        } else {
            return $this->detailAction($applicantLanguages->getApplicant()->getId());
        }
    }

    public function updateLanguageSaveAction(Request $request) {

        $form = $this->createForm(ApplicantLanguageType::class, new ApplicantLanguages());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantLanguages = $form->getData();
                $this->get("cuatrovientos_artean.bo.applicant")->updateApplicantLanguages($applicantLanguages);

                return $this->detailAction($applicantLanguages->getApplicant()->getId());
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function deleteLanguageAction($id) {
        $applicantLanguages= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantLanguagesById($id);
        if (null !=  $applicantLanguages) {
            $this->get("cuatrovientos_artean.bo.applicant")->deleteApplicantLanguages($applicantLanguages);
        }
        return $this->detailAction($applicantLanguages->getApplicant()->getId());
    }

    public function newJobAction(Request $request) {

        $form = $this->createForm(ApplicantJobType::class, new ApplicantJobs());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantJob = $form->getData();

                $this->get("cuatrovientos_artean.bo.applicant")->saveApplicantJobs($applicantJob);

                return $this->detailAction($applicantJob->getApplicant()->getId());
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function updateJobAction($id) {
        $applicantJob= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantJobsById($id);
        $applicantJob->getCompany();

        if (null !=  $applicantJob) {
            $formJob = $this->createForm(ApplicantJobType::class, $applicantJob);
            return $this->render('CuatrovientosArteanBundle:Applicant/Jobs:update.html.twig', array('formJob' => $formJob->createView(),'applicantJob'=>$applicantJob));
        } else {
            return $this->detailAction($applicantJob->getApplicant()->getId());
        }
    }

    public function updateJobSaveAction(Request $request) {

        $form = $this->createForm(ApplicantJobType::class, new ApplicantJobs());

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $applicantJob = $form->getData();
                $this->get("cuatrovientos_artean.bo.applicant")->updateApplicantJobs($applicantJob);

                return $this->detailAction($applicantJob->getApplicant()->getId());
            } else  {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:dashboard.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    public function deleteJobAction($id) {
        $applicantJobs= $this->get("cuatrovientos_artean.bo.applicant")->selectApplicantJobsById($id);
        if (null !=  $applicantJobs) {
            $this->get("cuatrovientos_artean.bo.applicant")->deleteApplicantJobs($applicantJobs);
        }
        return $this->detailAction($applicantJobs->getApplicant()->getId());
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

            } else {
                $response = $this->render('CuatrovientosArteanBundle:Applicant:signIn.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    public function applicantSignUpAction(Request $request)
    {
        $form = $this->createForm(ApplicantSignUpType::class, new Applicant());
        $form->handleRequest($request);

        return $this->render('CuatrovientosArteanBundle:Applicant:signUp.html.twig', array('form'=>$form->createView()));
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

                $user = $this->get("cuatrovientos_artean.bo.security")->findUserByEmail($applicant->getEmail());
                if ($user != null) {
                    //$response = $this->render('CuatrovientosArteanBundle:Applicant:signUp.html.twig', array('form'=> $form->createView()));
                    $request->getSession()
                        ->getFlashBag()
                        ->add('info', 'El email '. $applicant->getEmail(). ' ya está registrado. Prueba a entrar o resetea la cuenta en el enlace de abajo. ')
                    ;
                    return $this->redirectToRoute('cuatrovientos_artean_login');
                } else {
                    $user = new User();

                    $user->setFullname($applicant->getName() . ' ' . $applicant->getSurname());
                    $user->setLogin($applicant->getEmail());
                    $user->setEmail($applicant->getEmail());
                    $password = $user->randPassword();
                    $user->setPassword($password);

                    $this->get("cuatrovientos_artean.bo.security")->create($user);

                    //$this->saveStudies($applicant);
                    $this->createProfile($user->getId());

                    $this->get("cuatrovientos_artean.bo.applicant")->createNewApplicant($user);

                    $this->sendEmail($applicant);
                    $this->sendEmailUser($user, $password);

                    //return $this->redirect('https://artean.cuatrovientos.org/?home', 301);

                    $response = $this->render('CuatrovientosArteanBundle:Applicant:signUpSave.html.twig', array('applicant' => $applicant, 'user' => $user, 'password' => $password));
                }
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


    public function uploadCvAction($applicantid, Request $request)
    {
        $oldCvPath = "";
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($applicantid);
        if ($applicant->getCv() != "") {
            $oldCvPath =  $applicant->getCv();
            $applicant->setCv(new File($this->getParameter('cvs_directory') . '/' . $applicant->getCv()));
        }

        $form = $this->createForm(ApplicantCvType::class, $applicant);
        $form->handleRequest($request);

        if ($form->isSubmitted()) { //{} && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $applicant->getCv();

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                $this->getParameter('cvs_directory'),
                $fileName
            );

            if ($oldCvPath != "") {
                $this->get("cuatrovientos_artean.bo.filesystem")->deleteFile($this->getParameter('cvs_directory') . '/' . $oldCvPath);
            }

            $applicant->setCv($fileName);
            $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);

            return $this->detailAction($applicantid);
        }

        return $this->detailAction($applicantid);
    }


    public function uploadPhotoAction($applicantid, Request $request)
    {
        $oldPhotoPath = "";
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($applicantid);
        if ($applicant->getPhoto() != "") {
            $oldPhotoPath = $applicant->getPhoto();
            $applicant->setPhoto(new File($this->getParameter('photos_directory') . '/' . $applicant->getPhoto()));
        }

        $form = $this->createForm(ApplicantPhotoType::class, $applicant);
        $form->handleRequest($request);
        $logger = $this->get('logger');

        if ($form->isSubmitted()) { //{} && $form->isValid()) {
            $logger->info('Form seems ok: ' . $this->getParameter('photos_directory'));
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $applicant->getPhoto();

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move($this->getParameter('photos_directory'), $fileName);

            if ($oldPhotoPath != "") {
                $this->get("cuatrovientos_artean.bo.filesystem")->deleteFile($this->getParameter('photos_directory') . '/' . $oldPhotoPath);
            }

            $applicant->setPhoto($fileName);

            $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);

            return $this->detailAction($applicantid);
        } else {
            $logger->info('Form is not ok');
        }

        return $this->detailAction($applicantid);
    }


    public function deletePhotoAction($applicantid)
    {

        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($applicantid);

        $this->get("cuatrovientos_artean.bo.filesystem")->deleteFile($this->getParameter('photos_directory') . '/' . $applicant->getPhoto());

        $applicant->setPhoto(null);

        $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);

        return $this->detailAction($applicantid);
    }

    public function deleteCvAction($applicantid)
    {
        $applicant = $this->get("cuatrovientos_artean.bo.applicant")->findAllApplicantData($applicantid);

        $this->get("cuatrovientos_artean.bo.filesystem")->deleteFile($this->getParameter('cvs_directory') . '/' . $applicant->getCv());

        $applicant->setCv(null);

        $this->get("cuatrovientos_artean.bo.applicant")->update($applicant);

        return $this->detailAction($applicantid);
    }

}
