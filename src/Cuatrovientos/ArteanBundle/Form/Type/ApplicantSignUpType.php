<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ApplicantSignUpType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('name', TextType::class,array(
                "label"=>"Nombre",
                "required"=>true
                ))
            ->add('surname', TextType::class,array(
                "label"=>"Apellidos",
                "required"=>true
                ))
            ->add('email', EmailType::class,array(
                "label"=>"Email",
                "required"=>true
                ))
             ->add('mobile', TextType::class,array(
                "label"=>"Teléfono",
                "required"=>true
                ))
              ->add('studies', ChoiceType::class, array(
                    // each entry in the array will be an "email" field
                "label"=>"Titulacion(es)",
                      'choices'  => array(
                            'Ciclo Medio Comercio' => '9',
                            'Ciclo Medio Gestión Administrativa'     => '10',
                            'Ciclo Medio Sistemas Microinformáticos y Redes'    => '144',
                            'FP Básica'    => '143',
                            'Ciclo Superior Administración y Finanzas'    => '13',
                            'Ciclo Superior Transporte y Logística'    => '19',
                            'Ciclo Superior Comercio Internacional'    => '16',
                            'Ciclo Superior GVEC'    => '18',
                            'Ciclo Superior Redes y Sistemas'    => '15',
                            'Ciclo Superior de Desarrollo de Aplicaciones Informáticas'    => '17',
                        ),          
                    'choice_attr' => array('class' => 'form-control'),
                    'attr' => array('class' => 'checkboxblock'),
                    'expanded' => true,
                    'required' => true,
                    'multiple' => true
                    )
            )
            ->add('lopd', CheckboxType::class, array(
                'label'    => 'Acepto condiciones según LOPD',
                'required' => true,
                ))
            ->add('save', SubmitType::class,array(
                'label' =>'Darse de Alta'
                ));
        
         /* $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $data = $event->getData();
                if (isset($data['position'])) {
                     $data['position'] = $data['company'] .': ' .$data['position'];
                }

                $event->setData($data);
        });*/
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\ApplicantOpen',
        ));
    }

    public function getName() {
        return 'center';
    }
}