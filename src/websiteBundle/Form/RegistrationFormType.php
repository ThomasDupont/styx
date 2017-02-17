<?php

namespace websiteBundle\Form;

use coreBundle\Entity\WebsiteZone;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
//            ->add('name', EntityType::class, array(
//                'class' => 'coreBundle\Entity\WebsiteZone',
//                'query_builder' => function (EntityRepository $er) {
//                    return $er->createQueryBuilder('u')
//                        ->orderBy('u.name', 'ASC');
//                },
//                'choice_label' => 'name',
//            ))
//            ->add('city', 'text',array('label'=>'Prénom'))
            ->add('city', EntityType::class, array(
                'class' => WebsiteZone::class,
                'property' => 'name'
            ))
//            ->add('school', TextType::class,array('label'=>'École'))
//            ->add('cgu', CheckboxType::class,array('label'=>'CGU'))
            ->add('firstname', TextType::class,array('label'=>'Prénom'))
            ->add('name', TextType::class,array('label'=>'Nom'))
            ->add('email', TextType::class,array('label'=>'Email'))
            ->add('password', PasswordType::class,array('label'=>'Mot de passe'));
    }

//    public function getParent()
//    {
//        return 'fos_user_registration';
//    }

    public function getName()
    {
        return 'app_user_registration';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'coreBundle\Entity\WebsiteStyxuserbase',
        ));
    }
}