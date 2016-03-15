<?php


namespace MicroCMS\Domain;

/**
 * Description des profession
 *
 * @author thouars
 */
class Profession {

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
