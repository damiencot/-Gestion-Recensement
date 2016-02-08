<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


/**
 * Description of SituationFamillialeType
 *
 * @author thouars
 */
class SituationFamilleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('soeurEtFrere', 'text')
                ->add('enfantACharge', 'text');
    }

    public function getName() {
        return 'situationFamille';
    }



}
