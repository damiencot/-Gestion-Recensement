<?php


namespace MicroCMS\Domain;

/**
 * Description des Situation Matrimonial
 *
 * @author thouars
 */
class SituationMatrimonial {
    
    
    private $id;
    
    private $libelle;
    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }


}
