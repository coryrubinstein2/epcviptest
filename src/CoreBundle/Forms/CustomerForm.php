<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/27/19
 * Time: 10:48 AM
 */

namespace CoreBundle\Forms;
use CoreBundle\Entity\Customers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('email', EmailType::class)
            ->add('firstName', TextType::class, ['required' => false])
            ->add('lastName', TextType::class, ['required' => false])
            ->add('dateOfBirth', DateType::class,
            [
                'widget' => 'single_text',
                'format' => 'MM-dd-yyyy',
                'invalid_message' => 'The date format is not valid. Format: MM-dd-yyyy',
                'required' => false
            ])
            ->add('updatedAt', DateType::class,
            [
                'widget' => 'single_text',
                'format' => 'MM-dd-yyyy',
                'invalid_message' => 'The date format is not valid. Format: MM-dd-yyyy',
                'required' => false
            ])
            ->add('status', ChoiceType::class,
            [
                'choices' =>
                [
                    Customers::STATUS_NEW,
                    Customers::STATUS_PENDING,
                    Customers::STATUS_IN_REVIEW,
                    Customers::STATUS_APPROVED,
                    Customers::STATUS_INACTIVE,
                    Customers::STATUS_DELETED
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Customers::class]);
    }
}