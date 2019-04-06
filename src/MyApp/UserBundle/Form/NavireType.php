<?php
namespace MyApp\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Created by PhpStorm.
 * User: wajih
 * Date: 25/11/2016
 * Time: 12:20
 */
class NavireType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('compagnieNavale')
            ->add('villeDepart')
            ->add('villeArrivee')
            ->add('dateDepart' ,DateType::class,array( 'widget' => 'single_text'))

            ->add('dateArrivee',DateType::class,array( 'widget' => 'single_text'))
            ->add('nbrePlacesDispo' ,IntegerType::class)
            ->add('prix',IntegerType::class)
            ->add('idAdmin')
            ->add('Valider' ,SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\UserBundle\Entity\Navire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_userbundle_navire';
    }


}