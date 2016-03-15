<?php



namespace MicroCMS\Domain;

/**
 * Description des nationalités
 *
 * @author thouars
 */
class Nationalites {

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
