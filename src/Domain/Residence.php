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
class Residence extends Villes{

    private $id;
    private $adresse;
    private $telephone;
    protected $commune;
    protected $inseeVille;
    protected $codePostal;
    protected $idVilles;

    
    
    function getId() {
        return $this->id;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getCommune() {
        return parent::getCommune();
    }

    function getInseeVille() {
        return parent::getInseeVille();
    }
   
    function getCodePostal() {
       return  parent::getCodePostal();
    }
    
    function getIdVilles(){
        return parent::getId();
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

    function setCodePostal($codePostal) {
        parent::setCodePostal($codePostal);
    }

    function setCommune($commune) {
        parent::setCommune($commune);
    }

    function setInseeVille($inseeVille) {
        parent::setInseeVille($inseeVille);
    }
    
    function setIdVilles($id) {
         parent::setId($id);
    }



}
