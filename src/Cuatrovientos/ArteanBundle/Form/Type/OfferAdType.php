<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * INSERT INTO `tbestudios` (`id`, `codestudios`, `descripcion`) VALUES
(143, 'FP BAS', 'FP Básica'),
(144, 'CM SMI', 'Ciclo Medio Sistemas Microinformáticos y redes');

 */
class OfferAdType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('company', TextType::class,array(
                "label"=>"Empresa",
                "required"=>true,
                'translation_domain' => 'messages'
            ))
            ->add('address', TextType::class, array('label' => 'Dirección'))
            ->add('city', TextType::class, array('label' => 'Localidad'))
            ->add('activity', TextareaType::class, array('label' => 'Actividad económica'))
            ->add('contactPerson', TextType::class, array('label' => 'Persona de contacto'))
            ->add('contactEmail', TextType::class, array('label' => 'Email de contacto'))
            ->add('contactPhone', TextType::class, array('label' => 'Teléfono de contacto'))
            ->add('position', TextType::class, array('label' => 'Puesto'))
            ->add('description', TextareaType::class, array('label' => 'Descripción', 'attr' => array('placeholder'=> 'Funciones a desarrollar')))
            ->add('position_no', TextType::class,array('label' => 'Nº vacantes','data'=> 1))
            ->add('contract', TextareaType::class, array('label' => 'Tipo y duración de contrato', 'attr' => array('placeholder'=> 'Ejemplo: prácticas, 6 meses')))
            ->add('workday', TextType::class, array('label' => 'Jornada'))
            ->add('required_studies', ChoiceType::class, array('label'=> 'Formación requerida',
                    // each entry in the array will be an "email" field
                    'choices'  => array(
                        'Ciclo Medio Actividades Comerciales' => 'ACOM', //'9',
                        'Ciclo Medio Comercio' => 'ACOM', //'9',
                        'Ciclo Medio Gestión Administrativa'     => 'CM GA', //'10',
                        'Ciclo Medio Sistemas Microinformáticos y Redes'    => 'CM SMR', //'144',
                        'FP Básica'    => 'FPB', //'143',
                        'Ciclo Superior Administración y Finanzas'    => 'CS AF', //'13',
                        'Ciclo Superior Transporte y Logística'    => 'CS TL', //'19',
                        'Ciclo Superior Comercio Internacional'    => 'CS CI', //'16',
                        'Ciclo Superior GVEC'    => 'GVEC', //'18',
                        'Ciclo Superior Redes y Sistemas'    => 'CS ASIR', //'15',
                        'Ciclo Superior de Desarrollo de Aplicaciones Informáticas'    => 'CS DAM', //'17',
                    ),
                    'choice_attr' => array('class' => 'form-control'),
                    'attr' => array('class' => 'checkboxblock'),
                    'expanded' => true,
                    'multiple' => true
                )
            )
            ->add('required_languages', ChoiceType::class, array('label'=> 'Idiomas requeridos',
                    // each entry in the array will be an "email" field
                    'choices'  => array(
                        'Inglés' => 'IN',
                        'Francés'     => 'FR',
                        'Euskara'    => 'EU',
                        'Aleman'    => 'AL',
                        'Italiano'    => 'IT',
                        'Ruso'    => 'RU',
                        'Otros'    => 'OTROS',
                    ),
                    'attr' => array('class' => 'checkboxblock'),
                    'expanded' => true,
                    'multiple' => true
                )
            )
            ->add('other_knowledges', TextareaType::class, array('label'=>'Otros conocimientos'))
            ->add('observations', TextareaType::class, array('label' => 'Observaciones'))
            ->add('contact', TextareaType::class, array('label' => 'Contacto'))
            ->add('published', ChoiceType::class, array(
                    // each entry in the array will be an "email" field
                    'choices'  => array(
                        'No publicada' => '0',
                        'Convertida en solicitud'     => '5',
                        'Publicada'    => '6'
                    ),
                    'choice_attr' => array('class' => 'form-control'),
                    'required'=>false,
                    'expanded' => true,
                )
            )
            ->add('type',HiddenType::class)
            ->add('save', SubmitType::class, array('label'=> 'Enviar'));

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $data = $event->getData();
                if (isset($data['position'])) {
                    $data['position'] = $data['company'] .': ' .$data['position'];
                }
                $data['published'] = 0;
                $data['type'] = 1;
                $event->setData($data);
            });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\OfferAdOpen',
        ));
    }

    public function getName() {
        return 'offeradopen';
    }
}