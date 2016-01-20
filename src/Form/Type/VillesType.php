<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VillesType extends AbstractType {

   public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('inseeVille', 'text')
                ->add('codePostal', 'text')
                ->add('commune'   , 'text', array(
            'label' => 'commune',
            'attr' => array('placeholder' => 'commune')
        ));
    }

    public function getName()
    {
        return 'commune';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data' => 'namespace MicroCMS\Domain\Villes',
        ));
    }

}
