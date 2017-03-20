<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * INSERT INTO `tbestudios` (`id`, `codestudios`, `descripcion`) VALUES
(143, 'FP BAS', 'FP Básica'),
(144, 'CM SMI', 'Ciclo Medio Sistemas Microinformáticos y redes');

 */
class WorkOrderType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('description', TextType::class,array(
                "label"=>"Descripción",
                "required"=>true,
                'translation_domain' => 'messages'
              ))

            ->add('orderDate', TextareaType::class, array('label' => 'Fecha'))
            ->add('save', SubmitType::class, array('label'=> 'Enviar'));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\WorkOrder',
        ));
    }

    public function getName() {
        return 'workorder';
    }
}