<?php

namespace Jazzyweb\AulasMentor\AlimentosBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AlimentoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', 'text')
            ->add('energia', 'number')
            ->add('proteina', 'number')
            ->add('hidratocarbono', 'number')
            ->add('fibra', 'number')
            ->add('grasatotal', 'number')
            ->add('Agregar', 'submit', array('label' => 'Agregar'))
        ;
    }

    public function getName()
    {
        return 'alimento';
    }

    // Esto no es siempre necesario, pero para construir formularios embebidos
    // es imprescindibles, así que no cuesta nada acostumbrarse a ponerlo
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Jazzyweb\AulasMentor\AlimentosBundle\Entity\Alimento',
        );
    }
}