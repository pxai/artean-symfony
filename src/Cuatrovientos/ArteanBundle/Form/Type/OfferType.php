<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OfferType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('company', TextType::class,array(
   "label"=>"company",
   "required"=>true,
   'translation_domain' => 'messages'
 ))
            ->add('position', TextType::class, array('label' => 'Super Position'))
            ->add('functions', TextareaType::class)
            ->add('position_no', TextType::class, ['data'=> 1])
            ->add('contract_type', TextType::class)
            ->add('workday', TextType::class)
            ->add('required_studies', ChoiceType::class, array(
                    // each entry in the array will be an "email" field
                      'choices'  => array(
                            'Ciclo Medio Comercio' => 'nashville',
                            'Ciclo Medio Gestión Administrativa'     => 'paris',
                            'Ciclo Medio Sistemas Microinformáticos y Redes'    => 'berlin',
                            'FP Básica'    => 'london',
                            'Ciclo Superior Administración y Finanzas'    => 'london',
                            'Ciclo Superior Transporte y Logística'    => 'london',
                            'Ciclo Superior Comercio Internacional'    => 'london',
                            'Ciclo Superior GVEC'    => 'london',
                            'Ciclo Superior Redes y Sistemas'    => 'london',
                            'Ciclo Superior de Desarrollo de Aplicaciones Informáticas'    => 'london',
                        ),          
                                    'choice_attr' => array('class' => 'form-control'),
                    'attr' => array('class' => 'checkboxblock'),
                    'expanded' => true,
                    'multiple' => true
                    )
            )
                ->add('required_languages', ChoiceType::class, array(
                    // each entry in the array will be an "email" field
                      'choices'  => array(
                            'Inglés' => 'nashville',
                            'Francés'     => 'paris',
                            'Euskara'    => 'berlin',
                            'Aleman'    => 'london',
                            'Italiano'    => 'london',
                            'Ruso'    => 'london',
                            'Otros'    => 'london',
                        ),                 
                    'attr' => array('class' => 'checkboxblock'),
                    'expanded' => true,
                    'multiple' => true
                    )
            )
            ->add('other_knowledges', TextareaType::class)
            ->add('observations', TextareaType::class)
            ->add('contact', TextareaType::class)
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\OfferOpen',
        ));
    }

    public function getName() {
        return 'center';
    }
}