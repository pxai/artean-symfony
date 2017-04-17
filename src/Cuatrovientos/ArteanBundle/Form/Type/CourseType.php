<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CourseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('name', TextType::class, array('label' => 'Nombre',"required"=>true))
            ->add('startDate', DateTimeType::class, array('label' => 'Nombre',"required"=>false))
            ->add('endDate', DateTimeType::class, array('label' => 'Nombre',"required"=>false))
            ->add('hours', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('timetable', TextareaType::class, array('label' => 'Nombre',"required"=>false))
            ->add('classHoursDay', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('hoursDay', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('courseType', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('days', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('family', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('level', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('classroom', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('startSecondTerm', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('priceFirstTerm', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('priceSecondTerm', TextType::class, array('label' => 'Nombre',"required"=>false))
            ->add('book', TextType::class, array('label' => 'Nombre',"required"=>false))
           ->add('save', SubmitType::class, array('label' => 'Fecha'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Course',
        ));
    }

    public function getName() {
        return 'course';
    }
}