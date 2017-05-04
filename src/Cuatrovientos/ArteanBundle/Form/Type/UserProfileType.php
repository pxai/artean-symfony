<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Cuatrovientos\ArteanBundle\Entity\User;

class UserProfileType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', TextType::class,array(
                "label"=>"Usuario",
                "required"=>true
                ))
            ->add('email', TextType::class,array(
                "label"=>"Email",
                "required"=>true
            ))
            ->add('save', SubmitType::class,array(
                "label"=>"Modificar usuario"
                ));
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\User',
        ));
    }

      public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => true,
        ));
    }
    
    public function getName() {
        return 'user';
    }
}