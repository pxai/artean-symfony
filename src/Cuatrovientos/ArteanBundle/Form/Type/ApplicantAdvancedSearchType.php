<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use  Doctrine\ORM\EntityRepository;


class ApplicantAdvancedSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class,array(
                "label"=>"Nombre",
                "required"=>false
                ))
            ->add('surname', TextType::class,array(
                "label"=>"Apellidos",
                "required"=>false
                ))
            ->add('email', EmailType::class,array(
                "label"=>"Email",
                "required"=>false
                ))
            ->add('studies', EntityType::class, array(
                    'label' => 'Estudios',
                    'class' => 'CuatrovientosArteanBundle:Degree',
                    'attr' => array('class' => 'checkboxblock'),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.id < 10');
                    },
                    'expanded' => true,
                    'multiple' => true
                )
            )
            ->add('languages', EntityType::class, array(
                    'label' => 'Idiomas',
                    'class' => 'CuatrovientosArteanBundle:Language',
                    'attr' => array('class' => 'checkboxblock'),
                    'expanded' => true,
                    'multiple' => true
                )
            )
            ->add('drivingLicense', ChoiceType::class,array(
                "label"=>"Carnet de conducir",
                'choices'  => array('Tengo carnet' => '1'),
                "required"=>false
            ))
            ->add('move', ChoiceType::class, array(
                'label' => 'Posibilidad desplazamiento',
                'choices'  => array('Puedo desplazarme' => '1'),
                'required'=>false
            ))
            ->add('birth', TextType::class,array(
                "label"=>"Fecha de nacimiento",
                "required"=>false
            ))
            ->add('save', SubmitType::class,array(
                'label' =>'Buscar'
                ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Applicant',
        ));
    }

    public function getName() {
        return 'applicant';
    }
}