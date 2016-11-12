<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class OfferAdType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('company', TextType::class,array(
                "label"=>"Empresa",
                "required"=>true,
                'translation_domain' => 'messages'
              ))
            ->add('position', TextType::class, array('label' => 'Puesto'))
            ->add('location', TextType::class, array('label' => 'Localidad'))
            ->add('description', TextareaType::class, array('label' => 'Descripción'))
            ->add('positionNo', TextType::class,array('label' => 'Nº Vacantes', 'data'=>1))
            ->add('contractType', EntityType::class, array(
                    'class' => 'CuatrovientosArteanBundle:ContractType',
                   'label' => 'Tipo de contrato' )
            )
            ->add('workday', TextType::class, array('label' => 'Horario'))
            ->add('requiredStudies', ChoiceType::class, array(
                    'label' => 'Estudios requeridos',
                    // each entry in the array will be an "email" field
                      'choices'  => array(
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
            ->add('otherKnowledges', TextareaType::class, array('label' => 'Otros conocimientos'))
            ->add('observations', TextareaType::class, array('label' => 'Observaciones'))
            ->add('contact', TextareaType::class, array('label' => 'Información de contacto'))
            ->add('cvDate', DateType::class, array('label' => 'Fecha de CV'))
            ->add('save', SubmitType::class);
        
          $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $data = $event->getData();
                if (isset($data['position'])) {
                     $data['position'] = $data['company'] .': ' .$data['position'];
                }

                $event->setData($data);
        });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\OfferAdOpen',
        ));
    }

    public function getName() {
        return 'center';
    }
}