<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Cuatrovientos\ArteanBundle\Entity\TeacherCourse;
use Cuatrovientos\ArteanBundle\Entity\Course;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TeacherCourseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('course', EntityType::class, array('class'=>'CuatrovientosArteanBundle:Course'))
            ->add('userName', TextType::class, array('label' => 'Profesor',"required"=>false))
            ->add('hours', TextType::class, array('label' => 'Horas',"required"=>false))
            ->add('save', SubmitType::class, array('label' => 'Fecha'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\TeacherCourse',
        ));
    }

    public function getName() {
        return 'teacher_course';
    }
}