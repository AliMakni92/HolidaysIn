<?php

namespace MyApp\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;





class ReservationVoitureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('datereservation',DateType::class, array(
            'widget' => 'single_text', 'format' => 'dd-MM-yyyy','attr' => [
                'class' => 'form-control input-inline datepicker',
                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy'
            ]))->add('datefinreservation',DateType::class, array(
            'widget' => 'single_text', 'format' => 'dd-MM-yyyy','attr' => [
                'class' => 'form-control input-inline datepicker',
                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy'
            ]))->add('Valider' ,SubmitType::class)     ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\UserBundle\Entity\ReservationVoiture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_userbundle_reservationvoiture';
    }


}
