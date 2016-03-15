<?php


namespace MicroCMS\Domain;

/**
 * Description des Diplomes
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
