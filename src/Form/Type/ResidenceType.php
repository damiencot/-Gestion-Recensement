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
class ResidenceType extends AbstractType {
    
   
    
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('adresse', 'text')
                ->add('telephone', 'text')
                ->add('inseeVille', 'text')
                ->add('commune', 'text')
                ->add('codePostal', 'text');
                //->add('commune',  'choice',  array('choices' =>  $this->commune, 'expanded'=>false, 'multiple'=>false));
        
     
      
    }

    public function getName() {
        return 'residence';
    }
    
     public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data' => 'namespace MicroCMS\Domain\Residence',
        ));
    }

}
