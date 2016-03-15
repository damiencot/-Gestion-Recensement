<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of Adresse
 *
 * @author thouars
 */
class FilliationParentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', 'text')
                ->add('prenom', 'text')
                ->add('dateNaissance', 'text')
                ->add('sexe', 'text')
                ->add('pays', 'text');


    }

    public function getName() {
        return 'filliationParents';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data' => 'namespace MicroCMS\Domain\FilliationParent',
        ));
    }

}
