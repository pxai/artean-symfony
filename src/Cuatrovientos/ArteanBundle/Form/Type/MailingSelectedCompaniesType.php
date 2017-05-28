<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use  Doctrine\ORM\EntityRepository;


class MailingSelectedCompaniesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id', HiddenType::class,array(
                "label"=>"Id",
                "required"=>true
                ))
            ->add('selectedCompanies', EntityType::class, array(
                    'label' => 'Seleccionados',
                    'class' => 'CuatrovientosArteanBundle:Company',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where("c.email <> ''");
                },
                    'expanded' => true,
                    'multiple' => true
                ))

            ->add('save', SubmitType::class,array(
                'label' =>'Buscar'
                ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\Mailing',
        ));
    }

    public function getName() {
        return 'mailing_companies';
    }
}