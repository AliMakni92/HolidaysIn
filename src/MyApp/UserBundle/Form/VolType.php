<?php

namespace MyApp\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class VolType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('compagnieAerienne')
            ->add('aeroportDepart')
            ->add('aeroportArrivee')
            ->add('dateDepart',DateType::class,array( 'widget' => 'single_text'))
            ->add('dateArrivee',DateType::class,array( 'widget' => 'single_text'))
            ->add('nbrePlacesDispo',IntegerType::class)
            ->add('prix',IntegerType::class)
            ->add('id')
            ->add('Valider' ,SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\UserBundle\Entity\Vol'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_userbundle_vol';
    }


}
