<?php

namespace websiteBundle\Form;

use coreBundle\Entity\WebsiteZone;
use coreBundle\Entity\WebsiteDepartment;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateAssociationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->remove('username')
            ->add('avatar', FileType::class,array('label'=>'Avatar', 'data_class' => null))
            ->add('name', TextType::class, array('label'=>'Nom'))
            ->add('address', TextType::class, array('label'=>'Adresse'))
            ->add('mobile', TextType::class, array('label'=>'Mobile'))
            ->add('email', TextType::class, array('label'=>'Email'))
            ->add('plainPassword', PasswordType::class, array('label'=>'Mot de passe'))
            ->add('facebook', TextType::class, array(
                "mapped" => false,
                "label" => 'Facebook',
            ))
            ->add('youtube', TextType::class, array(
                "mapped" => false,
                "label" => 'YouTube',
            ))
            ->add('twitter', TextType::class, array(
                "mapped" => false,
                "label" => 'Twitter',
            ))
            ->add('submit', SubmitType::class, array('label'=>'M\'inscrire'));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
//        return 'fos_user_registration';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'coreBundle\Entity\WebsiteStyxuserbase',
        ));
    }
}
