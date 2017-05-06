<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\Requiredype;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ResetPasswordType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('validate', HiddenType::class, array(
        'required' => 'true'));
        $builder->add('newPassword',RepeatedType::class, array(
            'type' => PasswordType::class,
            'label'=> 'Nueva contraseña',
            'invalid_message' => 'Las contraseñas deben coincidir.',
            'required' => true,
            'first_options'  => array('label' => 'Nueva contraseña','attr' => array('class'=>"form-control")),
            'second_options' => array('label' => 'Reescribir nueva contraseña','attr' => array('class'=>"form-control")),
        ));
        $builder->add('save', SubmitType::class,array(
            "label"=>"Cambiar contraseña"
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\ChangePassword',
        ));
    }

    public function getName()
    {
        return 'change_passwd';
    }
}