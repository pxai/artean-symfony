<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ApplicantType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('active', ChoiceType::class, array(
                    'choices'  => array(
                        'Habilitado' => '1',
                        'Deshabilitado'     => '0'),
                    'label' => 'Estado de candidatura' )
            )
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
            ->add('web', TextType::class,array(
                "label"=>"Web/perfil/linkedin",
                "required"=>false
            ))
            ->add('mobile', TextType::class,array(
                "label"=>"Teléfono",
                "required"=>true
            ))
            ->add('address', TextType::class,array(
                "label"=>"Dirección",
                "required"=>false
            ))
            ->add('city', TextType::class,array(
                "label"=>"Localidad",
                "required"=>false
            ))
            ->add('province', TextType::class,array(
                "label"=>"Provincia",
                "required"=>false
            ))
            ->add('postalCode', TextType::class,array(
                "label"=>"Código Postal",
                "required"=>false
            ))
            ->add('phone', TextType::class,array(
                "label"=>"Teléfono secundario",
                "required"=>false
            ))
            ->add('drivingLicense', ChoiceType::class,array(
                "label"=>"Carnet de conducir",
                'choices'  => array('Tengo carnet' => '1'),
                "required"=>false
            ))
            ->add('move', ChoiceType::class, array(
                'label' => 'Posibilidad desplazamiento',
                'choices'  => array('Puedo desplazarme' => '1'),
                'required'=>false
            ))
            ->add('birth', TextType::class,array(
                "label"=>"Fecha de nacimiento",
                "required"=>false
            ))
            ->add('resume', TextareaType::class,array(
                "label"=>"Resumen",
                "required"=>false
            ))
            ->add('cv',HiddenType::class)
            ->add('photo',HiddenType::class)
            ->add('save', SubmitType::class);
        
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
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Applicant',
        ));
    }

    public function getName() {
        return 'applicant';
    }
}