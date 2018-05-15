<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AlquilerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('fechaIni', TextType::Class, array(
			'required' => 'required',
			'attr' => array(
                'placeholder' => 'dd/mm/aaaa',
                'class' => 'form-name form-control',
                'maxlength' => '10'
			)))
        ->add('fechaFin', TextType::Class, array(
			'required' => 'required',
			'attr' => array(
                'placeholder' => 'dd/mm/aaaa',
                'class' => 'form-name form-control',
                'maxlength' => '10'
			)))
        ->add('direccion', TextType::Class, array(
			'required' => 'required',
			'attr' => array(
                'placeholder' => 'Dirección del apartamento',
                'class' => 'form-name form-control'
			)))
        ->add('user')
        ->add('Alquilar', SubmitType::Class, array(
            'attr' => array(
            'class' => 'form-submit btn btn-primary',
            'style' => 'margin:2% auto')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Alquiler'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_alquiler';
    }


}
