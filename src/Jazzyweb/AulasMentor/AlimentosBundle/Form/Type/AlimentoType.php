<?php

namespace Jazzyweb\AulasMentor\AlimentosBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlimentoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class)
            ->add('energia', NumberType::class)
            ->add('proteina', NumberType::class)
            ->add('hidratocarbono', NumberType::class)
            ->add('fibra', NumberType::class)
            ->add('grasatotal', NumberType::class)
            ->add('Agregar', SubmitType::class, array('label' => 'Agregar'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jazzyweb\AulasMentor\AlimentosBundle\Entity\Alimento'
        ));
    }
}