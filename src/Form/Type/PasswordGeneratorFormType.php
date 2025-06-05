<?php declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordGeneratorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('special_symbols', CheckboxType::class, [
                'required' => false,
                'label' => 'Strong password',
            ])
            ->add('numbers', CheckboxType::class, [
                'required' => false,
                'label' => 'Numbers',
            ])
            ->add('length', IntegerType::class, [
                'required' => true,
                'label' => 'Password length',
            ]);

    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'data_class' => null,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
