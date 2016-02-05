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
 * Description of SituationFamillialeType
 *
 * @author thouars
 */
class StatusChoixType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder->add('status', 'choice', array(
                    'label' => 'Scolaire ?',
                    'choices' => array(1 => 'Oui', 0 => 'Non'),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true
                ));
        
        

        if ($builder == true) {
            $scolaire = new SituationScolaireType();
            return $scolaire;
        } else {
            $profession = new ProfessionType();
            return $profession;
        }
    }

    public function getName() {
        return 'statusChoix';
    }

}
