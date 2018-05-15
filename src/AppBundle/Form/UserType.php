<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::Class, array(
			'required' => 'required',
			'attr' => array(
				'class' => 'form-name form-control'
			)))
        ->add('password', PasswordType::Class, array(
			'required' => 'required',
			'attr' => array(
				'class' => 'form-name form-control'
			)))
        ->add('email', EmailType::Class, array(
			'required' => 'required',
			'attr' => array(
				'class' => 'form-name form-control'
			)))
        ->add('dni', TextType::Class, array(
			'required' => 'required',
			'attr' => array(
				'class' => 'form-name form-control'
			)))
        ->add('nombre', TextType::Class, array(
			'required' => 'required',
			'attr' => array(
				'class' => 'form-name form-control'
			)))
        ->add('apellidos', TextType::Class, array(
			'required' => 'required',
			'attr' => array(
				'class' => 'form-name form-control'
			)))
        ->add('telefono', TextType::Class, array(
			'required' => 'required',
			'attr' => array(
				'class' => 'form-name form-control'
			)))
        ->add('Registrar', SubmitType::Class, array(
            'attr' => array(
            'class' => 'form-submit btn btn-primary',
            'style' => 'margin-top:5%')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
