<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of SituationScolaire
 *
 * @author thouars
 */
class SituationScolaire extends Diplome {
    
    private $id;
    
    private $etude;
    
    private $specialites;
    
    protected $nom;
    
    private $status = true;
            
    function getId() {
        return $this->id;
    }

    function getEtude() {
        return $this->etude;
    }

    function getSpecialites() {
        return $this->specialites;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEtude($etude) {
        $this->etude = $etude;
    }

    function setSpecialites($specialites) {
        $this->specialites = $specialites;
    }

    function getNom() {
        return $this->nom;
    }

    function getStatus() {
        return $this->status;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setStatus($status) {
        $this->status = $status;
    }


    
}
