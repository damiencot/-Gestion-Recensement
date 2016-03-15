<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class RecenseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', 'text')
                ->add('prenom', 'text')
                ->add('nomUsage', 'text')
                ->add('dateNaissance', 'text')
                /*->add('dateNaissance','Date', array(
                    'label' => 'Date de naissance',
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy'))*/
                ->add('adresseMail', 'email')
                ->add('telephonePortable', 'text')
                ->add('dateEnregistrement', 'text');

    }

    public function getNom() {
        return 'recense';
    }

}
