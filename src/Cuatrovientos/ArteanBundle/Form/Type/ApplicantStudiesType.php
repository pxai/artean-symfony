<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ApplicantStudiesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)

            ->add('description', TextareaType::class, array('label' => 'Descripción', 'required'=>true))
            ->add('studies', EntityType::class, array(
                    'class' => 'CuatrovientosArteanBundle:Studies',
                   'label' => 'Estudios' )
            )
            ->add('center', EntityType::class, array(
                    'class' => 'CuatrovientosArteanBundle:Center',
                    'label' => 'Centro' )
            )
            ->add('endYear', TextType::class, array('label' => 'Año fin', 'required'=>false))
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\ApplicantStudies',
        ));
    }

    public function getName() {
        return 'applicant_studies';
    }
}