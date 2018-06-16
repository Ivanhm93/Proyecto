<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApartamentoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
    ->add('nombre', TextType::Class, array(
        'required' => 'required',
        'attr' => array(
            'class' => 'form-name form-control'
        )))
    ->add('precio', NumberType::Class, array(
        'required' => 'required',
        'attr' => array(
            'class' => 'form-name form-control'
        )))
    ->add('numPersonas', NumberType::Class, array(
        'required' => 'required',
        'attr' => array(
            'class' => 'form-name form-control'
        )))
    ->add('numHabitaciones', NumberType::Class, array(
        'required' => 'required',
        'attr' => array(
            'class' => 'form-name form-control'
        )))
    ->add('direccion', TextType::Class, array(
        'required' => 'required',
        'attr' => array(
            'class' => 'form-name form-control'
        )))
    ->add('ubicacion', TextType::Class, array(
        'label' => 'Código Postal',
        'required' => 'required',
        'attr' => array(
            'class' => 'form-name form-control',
            'style' => 'margin-bottom:5%'
        )))
    ->add('descripcion', TextareaType::Class, array(
        'required' => 'required',
        'attr' => array(
            'class' => 'form-name form-control',
            'style' => 'margin-bottom:5%; max-height: 200px;'
        )))
    ->add('imagen', FileType::Class, array(
        'required' => true,
        'data_class' => null,
		'attr' => array(
            'class' => 'form-control',
            'style' => 'margin-bottom:5%'
		)))
    ->add('localidad')   
    ->add('Modificar', SubmitType::Class, array(
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
            'data_class' => 'AppBundle\Entity\Apartamento'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_apartamento';
    }


}
