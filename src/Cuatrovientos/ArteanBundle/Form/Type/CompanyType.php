<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompanyType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('cif', TextType::class, array('label' => 'Cif',"required"=>true))

    /**
     * @ORM\Column(name="empresa",type="string", length=70)
     */
    ->add('empresa', TextType::class, array('label' => 'Empresa',"required"=>true))

    /**
     * @ORM\Column(name="contacto",type="string", length=255)
     */
    ->add('contacto', TextareaType::class, array('label' => 'Contacto',"required"=>true))

    /**
     * @ORM\Column(name="actividad",type="string", length=60)
     */
    ->add('actividad', TextType::class, array('label' => 'Actividad',"required"=>true))

    /**
     * @ORM\Column(name="direccion",type="string", length=100)
     */
    ->add('direccion', TextType::class, array('label' => 'Dirección',"required"=>true))

    /**
     * @ORM\Column(name="poblacion",type="string", length=100)
     */
    ->add('poblacion', TextType::class, array('label' => 'Población',"required"=>true,'data' => 'Pamplona/Iruñea'))

    /**
     * @ORM\Column(name="provincia",type="string", length=100)
     */
    ->add('provincia', TextType::class, array('label' => 'Fecha',"required"=>false,'data' => 'Navarra/Nafarroa'))

    /**
     * @ORM\Column(name="codigpostal",type="string", length=10)
     */
    ->add('codigpostal', TextType::class, array('label' => 'Fecha',"required"=>true,'data' => '31001'))

    /**
     * @ORM\Column(name="telefono",type="string", length=30)
     */
    ->add('telefono', TextType::class, array('label' => 'Teléfono',"required"=>true,'data' => '948'))

    /**
     * @ORM\Column(name="fax",type="string", length=30)
     */
    ->add('fax', TextType::class, array('label' => 'Fax',"required"=>false))

    /**
     * @ORM\Column(name="email",type="string", length=100)
     */
    ->add('email', TextType::class, array('label' => 'Email',"required"=>true))

    /**
     * @ORM\Column(name="web",type="string", length=100)
     */
    ->add('web', TextType::class, array('label' => 'Web',"required"=>false,'data' => 'http://'))

    /**
     * @ORM\Column(name="fechaalta",type="string", length=100)
     */
    ->add('fechaalta', TextType::class, array('label' => 'Fecha alta',"required"=>false))

    /**
     * @ORM\Column(name="fechaactualizacion",type="string", length=100)
     */
    ->add('fechaactualizacion', TextType::class, array('label' => 'Fecha actualización',"required"=>false))

    /**
     * @ORM\Column(name="baja",type="integer")
     */
    ->add('baja', TextType::class, array('label' => 'Baja',"required"=>false))

    /**
     * @ORM\Column(name="DateType",type="string", length=100)
     */
    ->add('fechabaja', TextType::class, array('label' => 'Fecha baja',"required"=>false))


    /**
     * @ORM\Column(name="TextAreaType",type="string", length=255)
     */
    ->add('pbservaciones', TextareaType::class, array('label' => 'Observaciones',"required"=>false))

    /**
     * @ORM\Column(name="fct",type="integer")
     */
    ->add('fct', TextType::class, array('label' => 'FCT',"required"=>true))


    /**
     * @ORM\Column(name="convenio",type="string", length=15)
     */
    ->add('convenio', TextType::class, array('label' => 'Convenio',"required"=>false))

    /**
     * @ORM\Column(name="convenio_pip",type="string", length=15)
     */
    ->add('convenio_pip', TextType::class, array('label' => 'Convenio PIP',"required"=>false))

    /**
     * @ORM\Column(name="convenio_dual",type="string", length=15)
     */
    ->add('convenio_dual', TextType::class, array('label' => 'Convenio Dual',"required"=>false))

    /**
     * @ORM\Column(name="convenio_pipdual",type="string", length=15)
     */
    ->add('convenio_pipdual', TextType::class, array('label' => 'Convenio PIP Dual',"required"=>false))
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Company',
        ));
    }

    public function getName() {
        return 'company';
    }
}