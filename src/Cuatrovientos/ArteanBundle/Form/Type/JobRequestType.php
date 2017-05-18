<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class JobRequestType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('offerdate', TextType::class, array('label'=>'Fecha solicitud',"required"=>true))
            ->add('companyName', TextType::class, array('label'=>'Empresa',"required"=>false))
            ->add('att', TextType::class, array('label'=>'Att' ,"required"=>false))
            ->add('greeting', TextType::class, array('label'=>'Saludo',"required"=>false))
            ->add('description', TextareaType::class, array('label'=>'Descripción',"required"=>true))
            ->add('province', TextType::class, array('label' => 'Provincia',"required"=>false))
            ->add('city', TextType::class, array('label' => 'Ciudad',"required"=>true))
            ->add('sex', ChoiceType::class, array(
                    'choices'  => array(
                        'Indiferente' => 2,
                        'Mujer' => '0',
                        'Hombre'     => '1'
                    ),
                    'choice_attr' => array('class' => 'form-control'),
                    'required'=>true,
                    'expanded' => true,
                )
            )
            ->add('schedule', TextType::class, array('label' => 'Horario','empty_data'=> 'No especificado',"required"=>false))
            ->add('contractType', TextType::class, array('label' => 'Tipo de contrato',"required"=>false))
            ->add('category', TextType::class, array('label' => 'Categoría',"required"=>false))
            ->add('requiredStudies', TextareaType::class, array('label' => 'Estudios requeridos',"required"=>false))
            ->add('profile', TextareaType::class, array('label' => 'Perfil',"required"=>false))
            ->add('skills', TextareaType::class, array('label' => 'Requisitos',"required"=>true))
            ->add('requiredLanguages', TextareaType::class, array('label' => 'Idiomas',"required"=>false))
            ->add('positionNo', TextType::class, array('label' => 'Vacantes','empty_data'=>1,"required"=>false))
            ->add('workday', TextType::class, array('label' => 'Jornada',"required"=>false))
            ->add('salary', TextType::class, array('label' => 'Salario',"required"=>false))
            ->add('urgent', ChoiceType::class, array(
                    'choices'  => array(
                        'Normal' => '0',
                        'Alta'     => '1',
                        'Baja' => 2
                    ),
                    'choice_attr' => array('class' => 'form-control'),
                    'required'=>true,
                    'expanded' => true,
                )
            )
            ->add('issues', TextareaType::class, array('label' => 'Incidencias',"required"=>false))
            ->add('notes', TextareaType::class, array('label' => 'Notas',"required"=>false))
            ->add('rating', TextType::class, array('label' => 'Valoración',"required"=>false))
            ->add('rating', ChoiceType::class, array(
                    'choices'  => array(
                        '0' => '0',
                        '1'     => '1',
                        '2'     => '2',
                        '3' => '3',
                        '4'     => '4',
                        '5'     => '5',
                        '6' => '6',
                        '7'     => '7',
                        '8'     => '8',
                        '9' => '9',
                        '10' => '10'
                        ),
                    'choice_attr' => array('class' => 'form-control'),
                    'required'=>false,
                    'expanded' => true,
                )
            )
            ->add('status', EntityType::class, array(
                    'class' => 'CuatrovientosArteanBundle:JobRequestStatus',
                    'label' => 'Estado de Solicitud' )
            )
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\JobRequest',
        ));
    }

    public function getName() {
        return 'job_request';
    }
}