<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FeedbackForm
 * @package App\Form
 * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
 */

class FeedbackForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [
            'label' => "Ваше Ім'я",
        ]);
        $builder->add('contacts', TextType::class, [
            'label' => 'Контактна Інформація',
        ]);
        $builder->add('description', TextareaType::class, [
            'label' => 'Ваша пропозиція або відгук',
        ]);
    }
}
