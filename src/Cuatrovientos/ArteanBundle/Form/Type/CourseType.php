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
            ->add('startDate', DateTimeType::class, array('label' => 'Fecha inicio',"required"=>false))
            ->add('endDate', DateTimeType::class, array('label' => 'Fecha fin',"required"=>false))
            ->add('hours', TextType::class, array('label' => 'Total horas',"required"=>false))
            ->add('timetable', TextareaType::class, array('label' => 'Horario',"required"=>false))
            ->add('classHoursDay', TextareaType::class, array('label' => 'Días de clase',"required"=>false))
            ->add('hoursDay', TextType::class, array('label' => 'Horas por día',"required"=>false))
            ->add('courseType', TextType::class, array('label' => 'Tipo de curso',"required"=>false))
            ->add('days', TextType::class, array('label' => 'Días',"required"=>false))
            ->add('family', TextType::class, array('label' => 'Familia',"required"=>false))
            ->add('level', TextType::class, array('label' => 'Nivel',"required"=>false))
            ->add('classroom', TextType::class, array('label' => 'Aula',"required"=>false))
            ->add('startSecondTerm', TextType::class, array('label' => 'Inicio segundo cuatrimestre',"required"=>false))
            ->add('priceFirstTerm', TextType::class, array('label' => 'Precio primer trimestre',"required"=>false))
            ->add('priceSecondTerm', TextType::class, array('label' => 'Precio segundo trimestre',"required"=>false))
            ->add('book', TextType::class, array('label' => 'Reserva matrícula',"required"=>false))
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