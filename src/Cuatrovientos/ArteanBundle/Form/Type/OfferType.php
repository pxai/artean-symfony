<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OfferType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('company', TextType::class)
            ->add('position', TextType::class)
            ->add('functions', TextType::class)
            ->add('position_no', TextType::class)
            ->add('contract_type', TextType::class)
            ->add('jornada', TextType::class)
            ->add('required_studies', TextType::class)
            ->add('other_knowledges', TextType::class)
            ->add('observations', TextType::class)
            ->add('contact', TextType::class)
            ->add('cv_reception_date', TextType::class)
            ->add('save', SubmitType::class);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Offer',
        ));
    }

    public function getName() {
        return 'center';
    }
}