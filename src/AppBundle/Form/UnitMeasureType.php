<?php
namespace AppBundle\Form;

use AppBundle\Entity\UnitMeasure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Formularz dla jednotki miary
 *
 * @author tomasz
 */
class UnitMeasureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('shortName')
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UnitMeasure::class,
            'csrf_protection' => false,
        ));
    }
}
