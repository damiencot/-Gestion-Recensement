<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of SituationFamille
 *
 * @author thouars
 */
class SituationFamille {

    private $id;
    
    private $soeurEtFrere;

    private $enfant;

    function getId() {
        return $this->id;
    }

    function getSoeurEtFrere() {
        return $this->soeurEtFrere;
    }

    function getEnfant() {
        return $this->enfant;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSoeurEtFrere($soeurEtFrere) {
        $this->soeurEtFrere = $soeurEtFrere;
    }

    function setEnfant($enfant) {
        $this->enfant = $enfant;
    }


}
