<?php

namespace App\Form;

use DateTimeZone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class MyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/')
                ],
                'attr'        => ['placeholder' => 'Y-m-d']
            ])
            ->add('timezone', TimezoneType::class)
            ->add('submit', SubmitType::class, ['label' => 'Submit']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'timezone' => DateTimeZone::listIdentifiers()
            ]
        );
    }
}
