<?php

namespace websiteBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
//            ->add('city', 'text',array('label'=>'Prénom'))
            ->add('school', TextType::class,array('label'=>'École'))
//            ->add('cgu', CheckboxType::class,array('label'=>'CGU'))
            ->add('firstname', TextType::class,array('label'=>'Prénom'))
            ->add('name', TextType::class,array('label'=>'Nom', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', TextType::class,array('label'=>'Email', 'translation_domain' => 'FOSUserBundle'))
            ->add('password', PasswordType::class,array('label'=>'Mot de passe', 'translation_domain' => 'FOSUserBundle'));
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