<?php

namespace MicroCMS\Domain;

/**
 * Description des Pupilles
 *
 * @author thouars
 */
class Pupille {
    
    
    private $id;
    
    private $nature;
    
    
    function getId() {
        return $this->id;
    }

    function getNature() {
        return $this->nature;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNature($nature) {
        $this->nature = $nature;
    }


    
}
