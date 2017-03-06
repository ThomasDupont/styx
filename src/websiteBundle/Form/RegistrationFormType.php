<?php

namespace websiteBundle\Form;

use coreBundle\Entity\WebsiteSchool;
use coreBundle\Entity\WebsiteZone;
use coreBundle\Entity\WebsiteDepartment;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder

            // ->add('name', EntityType::class, array(
            //    'class' => 'coreBundle\Entity\WebsiteZone',
            //    'query_builder' => function (EntityRepository $er) {
            //        return $er->createQueryBuilder('u')
            //            ->orderBy('u.name', 'ASC');
            //    },
            //    'choice_label' => 'name',
            // ))
            // ->add('city', 'text',array('label'=>'Prénom'))
            // ->add('city', EntityType::class, array(
            //    'class' => WebsiteZone::class,
            //    'property' => 'name'
            // ))
            // ->add('school', TextType::class,array('label'=>'École'))
            // ->add('cgu', CheckboxType::class,array('label'=>'CGU'))

            // ->add('city', 'entity', array(
            //   'class' => WebsiteDepartment::class,
            //   'property' => 'department',
            //   'required' => true,
            // ))

            ->remove('username')
            ->add('department', EntityType::class, array(
                'mapped' => false,
                'class' => WebsiteDepartment::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->from('coreBundle:WebsiteDepartment', 'wd')
                        ->orderBy('wd.id', 'ASC');
                },
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'name',
                'required' => true,
                'label' => false,
            ))
            ->add('school', EntityType::class, array(
                'class' => WebsiteSchool::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->from('coreBundle:WebsiteSchool', 'ws')
                        ->orderBy('ws.id', 'ASC');
                },
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'name',
                'required' => true,
                'label' => false,
            ))
            ->add('firstname', TextType::class, array('label'=>'Prénom'))
            ->add('name', TextType::class, array('label'=>'Nom'))
            ->add('email', TextType::class, array('label'=>'Email'))
            ->add('plainPassword', PasswordType::class, array('label'=>'Mot de passe'))
            ->add('submit', SubmitType::class, array('label'=>'M\'inscrire'))

            ->add('city', EntityType::class, array(
                'class'         => WebsiteZone::class,
                // 'query_builder' => function(EntityRepository $er) {
                //   return $er->createQueryBuilder('u')
                //   ->from('coreBundle:WebsiteDepartment', 'wd')
                //   ->where('u.department = :dep')
                //   ->orderBy('wd.id', 'ASC')
                //   ->setParameter('dep', '45');
                // },
                'expanded' => false,
                'multiple' => false,
                'choice_label' => 'zipcodename',
                'required' => true,
                'label' => false,
            ));
    }

    // protected function addElements(FormInterface $form, $department = null) {
    //   var_dump($department);
    //   exit;
    //   if(!empty($department)){
    //     $form = $event->getForm();
    //     $formOptions = array(
    //       'class'         => WebsiteZone::class,
    //       'property'      => 'id',
    //       'query_builder' => function(EntityRepository $er) {
    //         return $er->createQueryBuilder('u')
    //         ->from('coreBundle:WebsiteDepartment', 'wd')
    //         ->where('u.department = :dep')
    //         ->orderBy('wd.id', 'ASC')
    //         ->setParameter('dep', '45');
    //       },
    //       'expanded' => false,
    //       'multiple' => false,
    //       'choice_label' => 'name',
    //       'required' => true,
    //       'label' => false,
    //     );
    //       // create the field, this is similar the $builder->add()
    //       // field name, field type, data, options
    //       $form->add('city', 'entity', $formOptions);
    //   }
    //   else{
    //     $form->add('city', 'choice', array(
    //       'choice_label'=>'posttext',
    //       'empty_value' => '-- Choisis une ville --',
    //       'choices' => array())
    //     );
    //   }
    // }
    //
    // public function onPreSubmit(FormEvent $event)
    // {
    // $form = $event->getForm();
    // $data = $event->getData();
    //
    // $this->addElements($form, $data);
    // }

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
