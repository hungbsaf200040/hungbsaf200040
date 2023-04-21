<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Review;
use App\Entity\Author;
use App\Entity\Category;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, array('class' => 'App\Entity\Category', 'choice_label' => "catname"))
            ->add('author', EntityType::class, array('class' => 'App\Entity\Author', 'choice_label' => "authorname"))
            ->add('productname', TextType::class)
            ->add('description', TextareaType::class)
            ->add('tagname', TextType::class)
            ->add('productimg', FileType::class, [
                'label' => 'Image file',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ]);
    }
}
