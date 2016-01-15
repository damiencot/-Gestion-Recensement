<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of Adresse
 *
 * @author thouars
 */
class Residence {
    
    private $id;
    
    private $adresse;
    
    private $telephone;
    
    
    function getId() {
        return $this->id;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }


    
}
