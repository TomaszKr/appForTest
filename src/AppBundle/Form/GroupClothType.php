<?php
namespace AppBundle\Form;

use AppBundle\Entity\GroupCloth;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formularz dla grupy materiałów
 *
 * @author tomasz
 */
class GroupClothType extends AbstractType
{

    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
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

    /**
     * 
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => GroupCloth::class,
            'csrf_protection' => false,
        ));
    }
}
