<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use  Doctrine\ORM\EntityRepository;


class MailingSelectedApplicantsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id', HiddenType::class,array(
                "label"=>"Id",
                "required"=>true
                ))
            ->add('selectedApplicants', EntityType::class, array(
                    'label' => 'Seleccionados',
                    'class' => 'CuatrovientosArteanBundle:Applicant',

                    'expanded' => true,
                    'multiple' => true
                ))

            ->add('save', SubmitType::class,array(
                'label' =>'Buscar'
                ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Mailing',
        ));
    }

    public function getName() {
        return 'mailing';
    }
}