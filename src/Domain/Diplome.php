<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of Diplomes
 *
 * @author thouars
 */
class Diplome {
    
    
    private $id;
    
    private $diplome;
    
    
    function getId() {
        return $this->id;
    }

    function getDiplome() {
        return $this->diplome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDiplome($diplome) {
        $this->diplome = $diplome;
    }


}
