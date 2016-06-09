<?php 

namespace Cuatrovientos\ArteanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class NewsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id',HiddenType::class)
            ->add('title', TextType::class,array(
                "label"=>"Título",
                "required"=>true,
                'translation_domain' => 'messages'
              ))
            ->add('what', TextareaType::class,array(
                "label"=>"Noticia",
                "required"=>false,
                'translation_domain' => 'messages'
              ))
              ->add('status', ChoiceType::class, array(
                    // each entry in the array will be an "email" field
                      'choices'  => array(
                            'No publicada' => '0',
                            'Publicada solo para candidatos'     => '1',
                            'Publicada para todos'    => '2'
                        ),          
                    'choice_attr' => array('class' => 'form-control'),
                   'required'=>true,
                   'expanded' => true,
                    )
            )
             ->add('save', SubmitType::class);
        

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            $news = $event->getData();
            $form = $event->getForm();
            if (null != $news ) {
               // $news->encodeContent();
                $event->setData($news);
            }
        });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Cuatrovientos\ArteanBundle\Entity\News',
        ));
    }

    public function getName() {
        return 'news';
    }
}