<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('birthDate', DateType::class)
            ->add('email')
            ->add('telephone')
            ->add('webSite')
            ->add('status',ChoiceType::class, array(
                'choices'  => array(
                    'Choisissez votre status' => null,
                    'Particulier' => true,
                    'Professionnel' => false,
                ),
                // *this line is important*
                'choices_as_values' => true,
            ))
            ->add('city',ChoiceType::class, array(
                'choices'  => array(
                    'Choisissez votre ville' => null,
                    'Particulier' => true,
                    'Professionnel' => false,
                ),
                // *this line is important*
                'choices_as_values' => true,
            ))
            ->add('firm',ChoiceType::class, array(
                'choices'  => array(
                    'Choisissez votre société' => null,
                    'Particulier' => true,
                    'Professionnel' => false,
                ),
                // *this line is important*
                'choices_as_values' => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Personne'
        ));
    }
}
