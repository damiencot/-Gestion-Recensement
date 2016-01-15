<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of Pupille
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
