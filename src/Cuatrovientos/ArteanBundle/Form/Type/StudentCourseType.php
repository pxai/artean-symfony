<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Cuatrovientos\ArteanBundle\Entity\StudentCourse;
use Cuatrovientos\ArteanBundle\Entity\Course;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StudentCourseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('course', EntityType::class, array('class'=>'CuatrovientosArteanBundle:Course'))
            ->add('applicantName', TextType::class, array('label' => 'Estudiante',"required"=>false))
            ->add('employmentOffice', TextType::class, array('label' => 'Oficina de empleo',"required"=>false))
            ->add('getsPaid', TextType::class, array('label' => 'Cobra',"required"=>false))
            ->add('signUpDate', DateTimeType::class, array('input'=>'datetime','label' => 'Fecha alta',"required"=>false))
            ->add('dropInDate', DateTimeType::class, array('input'=>'datetime','label' => 'Fecha baja',"required"=>false))
            ->add('dropIn', TextType::class, array('label' => 'Baja',"required"=>false))
            ->add('endsCourse', TextType::class, array('label' => 'Finaliza curso',"required"=>false))
            ->add('dropInResult', TextType::class, array('label' => 'Resultado de baja',"required"=>false))
            ->add('grant', TextType::class, array('label' => 'Beca',"required"=>false))
            ->add('assessment', TextType::class, array('label' => 'Evaluación',"required"=>false))
            ->add('observations', TextareaType::class, array('label' => 'Observaciones',"required"=>false))
            ->add('deposit', TextType::class, array('label' => 'Ingreso',"required"=>false))
            ->add('pendingDeposit', TextType::class, array('label' => 'Ingreso pendiente',"required"=>false))
            ->add('chargeInvoice', TextType::class, array('label' => 'Cargar recibo',"required"=>false))
            ->add('invoiceAmount', TextType::class, array('label' => 'Importe recibo',"required"=>false))
            ->add('secondInvoice', TextType::class, array('label' => 'Ingreso 2º plazo',"required"=>false))
            ->add('recountingDays', TextType::class, array('label' => 'Días recuento final',"required"=>false))
            ->add('insurance', TextType::class, array('label' => 'Asegurar',"required"=>false))
            ->add('insuranceDays', TextType::class, array('label' => 'Días seguro',"required"=>false))
            ->add('turns', TextType::class, array('label' => 'Turnos',"required"=>false))
            ->add('save', SubmitType::class, array('label' => 'Guardar'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\StudentCourse',
        ));
    }

    public function getName() {
        return 'student_course';
    }
}