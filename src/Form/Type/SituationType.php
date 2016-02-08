<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SituationType
 *
 * @author thouars
 */
class SituationType extends AbstractType {

    //put your code here

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
               ->add('situation', 'entity', array(
                    'mapped' => false,
                    'class' => 'MySpaceMyBundle:Parcsimmobilier',
                    'property' => 'nom',
                    'empty_value' => '-- sélectionner une situation --',
                    'label' => 'Choisir la situation : ',
                ))
                ->add('scolaire', 'entity', array(
                    'mapped' => false,
                    'class' => 'MySpaceMyBundle:Ensembles',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->join('e.parcsimmobilier', 'p');
                    },
                    'property' => 'nom',
                    'empty_value' => '-- sélectionner un ensemble --',
                    'label' => 'Choisir l\'ensemble : ',
                ));

    
    }
}
    