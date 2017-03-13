<?php

namespace websiteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailNotificationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', HiddenType::class)
            ->add('name', HiddenType::class)
//            ->add('city', HiddenType::class)
//            ->add('birthday', HiddenType::class)
            ->add('mobile', HiddenType::class)
            ->add('zipCode', HiddenType::class)
            ->add('address', HiddenType::class)
            ->add('avatar', HiddenType::class)
            ->add('emailNotification', CheckboxType::class);

    }

    public function getName()
    {
        return 'update_profil';
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
