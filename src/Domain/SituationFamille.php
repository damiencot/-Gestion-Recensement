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

    private $enfantACharge;

    function getId() {
        return $this->id;
    }

    function getSoeurEtFrere() {
        return $this->soeurEtFrere;
    }

    function getEnfantACharge() {
        return $this->enfantACharge;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSoeurEtFrere($soeurEtFrere) {
        $this->soeurEtFrere = $soeurEtFrere;
    }

    function setEnfantACharge($enfantACharge) {
        $this->enfantACharge = $enfantACharge;
    }


}
