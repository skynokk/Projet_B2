<?php

namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('attr' => array('placeholder' => 'Nom',),'label' => false,))
            ->add('prenom', null, array('attr' => array('placeholder' => 'Prenom',),'label' => false,))
            ->add('mail', null, array('attr' => array('placeholder' => 'Mail',),'label' => false,))
            ->add('sexe', ChoiceType::class, array(
                'choices'   => array('Homme' => 'Homme', 'Femme' => 'Femme','Autre' => 'Autre'),
                'required'  => true,
            ))
            ->add('username', null, array('attr' => array('placeholder' => 'Login',),'label' => false,))
            ->add('password', PasswordType::class, array('attr' => array('placeholder' => 'Mot de Passe',),'label' => false,))
            ->add('confirm_password', PasswordType::class, array('attr' => array('placeholder' => 'Confirmer le Mot de Passe',),'label' => false,))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
