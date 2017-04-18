<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FctType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('companyName', TextType::class, array('label'=>'Empresa',"required"=>true))
            ->add('applicantName', TextType::class, array('label'=>'Alumno/a' ,"required"=>true))
            ->add('course', TextType::class, array('label'=>'Curso',"required"=>true))
            ->add('period', ChoiceType::class, array(
                    'choices'  => array(
                        'Marzo' => 'Marzo',
                        'Septiembre' => 'Septiembre',
                        'Otro' => 'Otro'
                    ),
                    'choice_attr' => array('class' => 'form-control'),
                    'required'=>true,
                    'expanded' => true,
                )
            )
            ->add('degree', EntityType::class, array(
                    'class' => 'CuatrovientosArteanBundle:Degree',
                    'label' => 'Ciclo' )
            )
            ->add('companyTutor', TextType::class, array('label' => 'Tutor empresa',"required"=>false))
            ->add('companyContact', TextType::class, array('label' => 'Contacto empresa',"required"=>false))
            ->add('schoolTutor', TextType::class, array('label' => 'Tutor del instituto',"required"=>false))
            ->add('fctDate', DateType::class, array('label' => 'Fecha',
                'years'=> range(date('Y')-15, date('Y')+2),"required"=>false))
            ->add('description', TextareaType::class, array('label' => 'Descripción',"required"=>false))
            ->add('resultados', TextareaType::class, array('label' => 'Resultados',"required"=>false))
            ->add('applicantRating', TextareaType::class, array('label' => 'Valoración del estudiante',"required"=>false))
            ->add('schoolRating', TextareaType::class, array('label' => 'Valoración del instituto',"required"=>false))
            ->add('companyRating', TextareaType::class, array('label' => 'Valoración de la empresa',"required"=>false))

            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Fct',
        ));
    }

    public function getName() {
        return 'fct';
    }
}