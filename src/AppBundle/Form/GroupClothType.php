<?php

use AppBundle\Entity\Cloth;
use AppBundle\Entity\GroupCloth;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Test\FormBuilderInterface;

namespace AppBundle\Form;

/**
 * Formularz dla grupy materiałów
 *
 * @author tomasz
 */
class GroupClothType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('parent', EntityType::class, array(
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
        ));
    }
}
