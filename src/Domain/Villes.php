<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of Villes
 *
 * @author thouars
 */
class Villes {
    
    private $id;
    
    private $inseeVille;
    
    private $nom;
    
    private $codePostal;
    
    function getId() {
        return $this->id;
    }

    function getInseeVille() {
        return $this->inseeVille;
    }

    function getNom() {
        return $this->nom;
    }

    function getCodePostal() {
        return $this->codePostal;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setInseeVille($inseeVille) {
        $this->inseeVille = $inseeVille;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
    }




}
