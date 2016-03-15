<?php

namespace MicroCMS\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username', 'text', array(
					'label' => ('Utilisateur'),
				))
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Les mots de passe doivent correspondre.',
                    'options' => array('required' => true),
                    'first_options' => array('label' => 'Mot de Passe'),
                    'second_options' => array('label' => 'Répéter Mot de Passe'),
                ))
                ->add('role', 'choice', array(
                    'choices' => array('ROLE_ADMIN' => 'Admin', 'ROLE_USER' => 'User')
        ));
    }

   

    public function getName() {
        return 'user';
    }

}
