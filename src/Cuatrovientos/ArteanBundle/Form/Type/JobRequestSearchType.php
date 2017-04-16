<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JobRequestSearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('cif', TextType::class, array('label' => 'Cif',"required"=>false))

    /**
     * @ORM\Column(name="empresa",type="string", length=70)
     */
    ->add('description', TextType::class, array('label' => 'Descripcion',"required"=>false))


    /**
     * @ORM\Column(name="fct",type="integer")
     */
    ->add('fct', CheckboxType::class, array('label' => '¿FCTs?', 'required'=>false))


    /**
     * @ORM\Column(name="convenio",type="string", length=15)
     */
    ->add('convenio', CheckboxType::class, array('label' => '¿Tiene convenio?', 'required'=>false));

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