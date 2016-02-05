<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of Nationalites
 *
 * @author thouars
 */
class Nationalites {
    //put your code here
    
    private $id;
    
    
    private $pays;
    
    
    private $inseePays;
    
    
    
    
    function getId() {
        return $this->id;
    }

    function getPays() {
        return $this->pays;
    }

    function getInseePays() {
        return $this->inseePays;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPays($pays) {
        $this->pays = $pays;
    }

    function setInseePays($inseePays) {
        $this->inseePays = $inseePays;
    }


}
