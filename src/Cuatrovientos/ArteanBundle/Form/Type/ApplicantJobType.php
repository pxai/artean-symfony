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


class ApplicantJobType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('applicant', EntityType::class, array('class'=>'CuatrovientosArteanBundle:Applicant'))
            ->add('companyName', TextType::class, array('label' => 'Empresa', 'required'=>true))
            ->add('contractType', TextType::class, array('label' => 'Tipo de contrato', 'required'=>true))
            ->add('description', TextareaType::class, array('label' => 'Descripción', 'required'=>true))
            ->add('endDate', TextType::class, array('label' => 'Fecha fin', 'required'=>false))
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\ApplicantJobs',
        ));
    }

    public function getName() {
        return 'applicant_job';
    }
}