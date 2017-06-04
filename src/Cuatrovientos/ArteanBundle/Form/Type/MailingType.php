<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MailingType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
             ->add('mailFrom', TextType::class, array('label' => 'De',"required"=>true))
            ->add('mailTo', TextType::class, array('label' => 'Para',"required"=>false))
            ->add('bcc', TextareaType::class, array('label' => 'Copia oculta',"required"=>false))
            ->add('subject', TextType::class, array('label' => 'Asunto',"required"=>true))
            ->add('body', TextareaType::class, array('label' => 'Mensaje',"required"=>true))
            ->add('mailDate', TextType::class, array('label' => 'Fecha',"required"=>false))
            ->add('type', TextType::class, array('label' => 'Tipo',"required"=>false))
            ->add('status', HiddenType::class)
            ->add('save', SubmitType::class, array('label' => 'Guardar mailing'));
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