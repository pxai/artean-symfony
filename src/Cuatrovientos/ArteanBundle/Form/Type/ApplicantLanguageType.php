<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ApplicantLanguageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)

            ->add('applicant', EntityType::class, array('class'=>'CuatrovientosArteanBundle:Applicant'))
            ->add('language', EntityType::class, array(
                    'class' => 'CuatrovientosArteanBundle:Language',
                   'label' => 'Idioma' )
            )
            ->add('speaking', EntityType::class, array(
                    'class' => 'CuatrovientosArteanBundle:LanguageLevel',
                    'label' => 'Nivel hablado' )
            )
            ->add('writing', EntityType::class, array(
                    'class' => 'CuatrovientosArteanBundle:LanguageLevel',
                    'label' => 'Nivel escrito' )
            )
            ->add('description', TextareaType::class, array('label' => 'Descripción', 'required'=>true))
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\ApplicantLanguages',
        ));
    }

    public function getName() {
        return 'applicant_languages';
    }
}