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
            ->add('position', TextType::class)
            ->add('functions', TextareaType::class)
            ->add('position_no', TextType::class, ['data'=> 1])
            ->add('contract_type', TextType::class)
            ->add('jornada', TextType::class)
            ->add('required_studies', CollectionType::class, array(
                    // each entry in the array will be an "email" field
                    'entry_type'   => TextType::class,
                    // these options are passed to each "email" type
                    'entry_options'  => array(
                        'attr'      => array('class' => 'email-box'),
                        'choices'  => array(
                            'Nashville' => 'nashville',
                            'Paris'     => 'paris',
                            'Berlin'    => 'berlin',
                            'London'    => 'london',
                        ),
                    ),
            ))
                ->add('required_languages', CollectionType::class, array(
                    // each entry in the array will be an "email" field
                    'entry_type'   => TextType::class,
                    // these options are passed to each "email" type
                    'entry_options'  => array(
                        'attr'      => array('class' => 'email-box'),
                        'choices'  => array(
                            'Nashville' => 'nashville',
                            'Paris'     => 'paris',
                            'Berlin'    => 'berlin',
                            'London'    => 'london',
                        ),
                    ),
            ))
            ->add('other_knowledges', TextareaType::class)
            ->add('observations', TextareaType::class)
            ->add('contact', TextareaType::class)
            ->add('cv_reception_date', DateType::class)
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Offer',
        ));
    }

    public function getName() {
        return 'center';
    }
}