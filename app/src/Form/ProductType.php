<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
              'required' => true,

              'class' => Product::class,
              'choice_label' => function ($product) {
                return $product->getName() . ' ' . $product->getPrice() . ' EUR';
            }
            ])
            ->add('code', null, [
              'required' => true,
              'constraints' => [
                new Assert\Regex([
                  'pattern' => '/^(it|de|gr)[0-9]+$/i',
                  'message' => 'This value is not valid. Use ITXXXX or GRXXXX or DEXXXX.'
                ])
              ]
            ])
            ->add('save', SubmitType::class, [
              'label' => 'Calc Tax'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
