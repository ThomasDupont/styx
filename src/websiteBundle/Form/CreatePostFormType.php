<?php

namespace websiteBundle\Form;


use coreBundle\Entity\PostPost;
use coreBundle\Entity\PostReward;
use coreBundle\Entity\WebsiteCategory;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePostFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('title', TextType::class, array('label'=>'Titre'))
    ->add('category', EntityType::class, array(
      'class' => WebsiteCategory::class,
      'property' => 'nameCategory'
    ))
    ->add('description', TextareaType::class, array('label'=>'Description'))
    ->add('rewards', 'entity', array(
      'class' => PostReward::class,
      'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('u')
        ->orderBy('u.id', 'ASC');
      },
      'expanded' => true,
      'multiple' => true,
      // 'choice_label' => 'name',
      'required' => false,
      'label' => false,
    ));
  }


  public function getName()
  {
    return 'create_post';
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => PostPost::class,
    ));
  }
}
