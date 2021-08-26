<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'required' => false,
            'label' => 'Article name',
        ]);
        $builder->add('description', TextareaType::class, [
            'required' => false,
            'label' => 'Short description text',
        ]);
        $builder->add('body', TextareaType::class, [
            'required' => false,
            'label' => 'Article body',
        ]);
        $builder->add('published', DateType::class, [
            'widget' => 'single_text',
        ]);
        $builder->add('submit',SubmitType::class);

    }

}