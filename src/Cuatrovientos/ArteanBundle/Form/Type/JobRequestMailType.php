<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JobRequestMailType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('from', EmailType::class, array('label'=>'De',"required"=>true))
            ->add('to', EmailType::class, array('label'=>'Para',"required"=>true))
            ->add('bcc', TextType::class, array('label'=>'Copia oculta',"required"=>false))
            ->add('subject', TextType::class, array('label'=>'Asunto',"required"=>true))
            ->add('content', TextareaType::class, array('label'=>'Mensaje',"required"=>true))
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