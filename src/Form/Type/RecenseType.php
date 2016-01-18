<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RecenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text')
            ->add('prenom', 'text')
            ->add('nomUsage', 'text')
            ->add('dateNaissance', 'text')
            ->add('adresseMail', 'email')
            ->add('telephonePortable', 'text')
            ->add('dateEnregistrement', 'text')
            ->add('commune', 'text');
    }

    public function getNom()
    {
        return 'recense';
    }
}