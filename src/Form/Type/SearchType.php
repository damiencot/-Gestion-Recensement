<?php
 

namespace MicroCMS\Form\Type;

namespace Symfony\Component\Form\Extension\Core\Type;

use Symfony\Component\Form\AbstractType;

class SearchType extends AbstractType
{
  
    public function getfilliationParent(array $options)
    {
        return 'text';
    }


    public function getName()
    {
        return 'search';
    }
}