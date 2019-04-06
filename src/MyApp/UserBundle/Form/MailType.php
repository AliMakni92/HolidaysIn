<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 30/11/2016
 * Time: 11:07
 */

namespace MyApp\UserBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 17/11/2016
 * Time: 19:31
 */
class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('tel', IntegerType::class)
            ->add('email', EmailType::class)
            ->add('text', TextareaType::class)
            ->add('valider', SubmitType::class) ;
    }

    public function getName()
    {
        return 'Mail';
    }
}
