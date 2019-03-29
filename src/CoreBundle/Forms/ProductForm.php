<?php
/**
 * Created by PhpStorm.
 * User: Corballs
 * Date: 3/27/19
 * Time: 11:29 AM
 */

namespace CoreBundle\Forms;
use CoreBundle\Entity\Customers;
use CoreBundle\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['required' => true])
            ->add('status', TextType::class, ['required' => false, 'empty_data' => 'new'])
            ->add('customer', EntityType::class, ['class' => Customers::class, 'required' => false])
            ->add('updatedAt', DateType::class,
            [
                'required' => false,
                'widget' => 'single_text',
                'format' => 'MM-dd-yyyy',
                'invalid_message' => 'The date format is not valid. Format: MM-dd-yyyy',
            ])
            ->add('deletedAt', DateType::class,
            [
                    'required' => false,
                    'widget' => 'single_text',
                    'format' => 'MM-dd-yyyy',
                    'invalid_message' => 'The date format is not valid. Format: MM-dd-yyyy',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Products::class]);
    }
}