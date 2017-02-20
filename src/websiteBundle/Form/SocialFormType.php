<?php

namespace websiteBundle\Form;


use coreBundle\Entity\WebsiteSocial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocialFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('email', HiddenType::class,array('label'=>'Email'))
//            ->add('name', HiddenType::class,array('label'=>'Nom'))
            ->add('facebook', TextType::class)
            ->add('youtube', TextType::class)
            ->add('twitter', TextType::class);
    }

    public function getName()
    {
        return 'update_social';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => WebsiteSocial::class,
        ));
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
