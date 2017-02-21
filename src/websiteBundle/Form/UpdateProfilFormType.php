<?php

namespace websiteBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('avatar', FileType::class,array('label'=>'Avatar', 'data_class' => null))
            ->add('name', TextType::class,array('label'=>'Nom'))
            ->add('email', TextType::class,array('label'=>'Email'))
            ->add('birthday', DateType::class,array('label'=>'Date de naissance'))
            ->add('mobile', TextType::class,array('label'=>'Email', 'max_length'=>'10'))
            ->add('address', TextType::class,array('label'=>'Adresse'))
            ->add('zipCode', TextType::class,array('label'=>'Code Postal'))
            ->add('city', EntityType::class, array(
            'class' => 'coreBundle\Entity\WebsiteZone',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->where('u.activated = true')
                    ->orderBy('u.name', 'ASC');
            },
            'choice_label' => 'name',
            ));
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
