<?php

declare(strict_types=1);

namespace App\Model\Quote\UseCases\Create;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('task', Type\TextType::class, ['label' => 'Task'])
            ->add('reference', Type\TextareaType::class, ['label' => 'Reference'])
            ->add('amount', Type\NumberType::class, ['label' => 'Amount'])
            ->add('percentage', Type\NumberType::class, ['label' => 'Percentage'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
            'csrf_protection' => false,
        ]);
    }
}
