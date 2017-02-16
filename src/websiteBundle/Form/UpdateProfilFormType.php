<?php

namespace websiteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateProfilFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avatar', FileType::class,array('label'=>'Avatar'))
            ->add('name', TextType::class,array('label'=>'Nom'))
            ->add('email', TextType::class,array('label'=>'Email'))
//            ->add('birthday', TextType::class,array('label'=>'Date de naissance'))
            ->add('mobile', TextType::class,array('label'=>'Email', 'max_length'=>'10'))
            ->add('adress', TextType::class,array('label'=>'Adresse'))
            ->add('zipCode', TextType::class,array('label'=>'Code Postal'));
//            ->add('city', TextType::class,array('label'=>'Ville'));
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