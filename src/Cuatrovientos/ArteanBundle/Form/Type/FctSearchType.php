<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FctSearchType extends AbstractType {

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
            ->add('degree', TextType::class, array('label' => 'Ciclo',"required"=>true))
            ->add('companyTutor', TextType::class, array('label' => 'Tutor empresa',"required"=>true))
            ->add('companyContact', TextType::class, array('label' => 'Contacto empresa',"required"=>true))
            ->add('schoolTutor', TextType::class, array('label' => 'Tutor del instituto',"required"=>true))
            ->add('fctDate', DateType::class, array('label' => 'Fecha',"required"=>true))
            ->add('description', TextareaType::class, array('label' => 'Descripción',"required"=>true))

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