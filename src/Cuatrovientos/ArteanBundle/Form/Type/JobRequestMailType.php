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

class JobRequestMailType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('from', TextType::class, array('label'=>'De',"required"=>true))
            ->add('to', TextType::class, array('label'=>'Para',"required"=>true))
            ->add('bcc', TextType::class, array('label'=>'Copia oculta',"required"=>true))
            ->add('subject', TextType::class, array('label'=>'Asunto',"required"=>true))
            ->add('content', TextType::class, array('label'=>'Mensaje',"required"=>true))
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\JobRequestMail',
        ));
    }

    public function getName() {
        return 'job_request_mail';
    }
}