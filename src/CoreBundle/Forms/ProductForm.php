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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductForm extends AbstractType
{
    public function formBuilder(FormBuilderInterface $builder)
    {
        $builder
            ->add('issn', TextType::class)
            ->add('name', TextType::class)
            ->add('status', TextType::class)
            ->add('customer', EntityType::class, ['class' => Customers::class]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Products::class]);
    }
}