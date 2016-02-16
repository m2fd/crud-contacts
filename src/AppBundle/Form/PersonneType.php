<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Url;

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
            ->add('birthDate', DateType::class,['widget' => 'single_text', 'format' => 'dd-MM-yyyy','attr' => [
                                'class' => 'form-control input-inline datepicker',
                                'data-provide' => 'datepicker',
                                'data-date-format' => 'dd-mm-yyyy']
                    ])
            ->add('email',EmailType::class)
            ->add('telephone')
            ->add('webSite')
            ->add('status',ChoiceType::class, array(
                'choices'  => array(
                    'Choisissez votre status' => null,
                    'Particulier' => '1',
                    'Professionnel' => '2'),

                // *this line is important*
                'choices_as_values' => true
            ))
            ->add('city',EntityType::class, array(
                'class' => 'AppBundle:City',
                'choice_label' => 'name',
        ))
            ->add('firm',EntityType::class,array(
                'class' => 'AppBundle:Firm',
                'choice_label' => function($firm){
                    return strtoUpper($firm->getName());
                },))
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
