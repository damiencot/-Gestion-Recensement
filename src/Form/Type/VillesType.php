<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class VillesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inseeVille', 'text')
            ->add('commune', 'text')
            ->add('codePostal', 'text');
    }

    public function getNom()
    {
        return 'villes';
    }
}