<?php

namespace websiteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('city', 'text',array('label'=>'Prénom'))
            ->add('school', 'text',array('label'=>'École'))
            ->add('firstname', 'text',array('label'=>'Prénom'))
            ->add('name', 'text',array('label'=>'Nom'))
            ->add('email', 'text',array('label'=>'Email'))
            ->add('password', 'password',array('label'=>'Mot de passe'))
            ->add('password', 'password',array('label'=>'Confirmation du mot de passe'))
            ->add('valider', 'submit', array('label'=>'s\'inscrire'));
    }
    

    public function getName()
    {
        return 'fos_user_registration';
    }

//    /**
//     * @param OptionsResolver $resolver
//     */
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'websiteBundle\Entity\Styxuserbase'
//        ));
//    }
}