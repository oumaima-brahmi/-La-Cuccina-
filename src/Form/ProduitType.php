<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prix')
            ->add('image', FileType::class, [
                'label' => 'Image (JPG file)',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        
                        'mimeTypesMessage' => 'Please upload a valid JPG document',
                    ]),
                    new NotBlank([
                        'message'=>'Please select an image',
                    ])
                ],
            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'PIZZA' => 'PIZZA',
                    'PASTA' => 'PASTA',
                    'BURGER' => 'BURGER',
                    'ASIANFOOD' => 'ASIANFOOD',
                    'SALAD' => 'SALAD',
                    
                    
                ],
                
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez choisir un Menu']),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
