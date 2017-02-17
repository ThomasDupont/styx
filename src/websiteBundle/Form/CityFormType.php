<?php

namespace websiteBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CityFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name', EntityType::class, array(
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
    return 'city';
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
