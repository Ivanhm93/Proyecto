<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ComentarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('texto', TextareaType::Class, array(
            'label' => 'Deja tu opinión',
            'attr' => array(
            'class' => 'form-control',
            'style' => 'max-height: 200px; min-width: 500px; min-height: 200px;'
        )))
        ->add('Comentar', SubmitType::Class, array(
            'attr' => array(
            'class' => 'form-submit btn btn-primary',
            'style' => 'margin:2% auto'
        )));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Comentario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_comentario';
    }


}
