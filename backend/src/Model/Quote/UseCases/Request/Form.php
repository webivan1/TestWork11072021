<?php

declare(strict_types=1);

namespace App\Model\Quote\UseCases\Request;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET')
            ->add('id', Type\NumberType::class, ['label' => 'Id'])
            ->add('task', Type\TextType::class, ['label' => 'Task'])
            ->add('currentPage', Type\NumberType::class, ['label' => 'Page'])
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
