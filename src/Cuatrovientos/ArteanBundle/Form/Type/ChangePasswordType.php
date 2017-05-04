<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', PasswordType::class, array(
        'label' => 'Contraseña anterior'));
        $builder->add('newPassword',RepeatedType::class, array(
            'type' => PasswordType::class,
            'label'=> 'Nueva contraseña',
            'invalid_message' => 'Las contraseñas deben coincidir.',
            'required' => true,
            'first_options'  => array('label' => 'Nuevo Password'),
            'second_options' => array('label' => 'Repetir nuevo Password'),
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