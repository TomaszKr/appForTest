<?php

namespace AppBundle\Form;

use AppBundle\Entity\Cloth;
use AppBundle\Entity\GroupCloth;
use AppBundle\Entity\UnitMeasure;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formularz dla materiałów
 *
 * @author tomasz
 */
class ClothType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('code')
            ->add('unitOfMeasure', EntityType::class, array(
                'class' => UnitMeasure::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                )
            )
            ->add('groupCloth', EntityType::class, array(
                'class' => GroupCloth::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                )
            )
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Cloth::class,
            'csrf_protection' => false,
        ));
    }
}
