<?php



namespace MicroCMS\Domain;

/**
 * Description des Situation Scolaire
 *
 * @author thouars
 */
class SituationScolaire extends Diplome {
    
    private $id;
    
    private $etude;
    
    private $specialites;
    
    protected $diplome;
    
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

    function getDiplome() {
         return parent::getDiplome();
    }

    function getStatus() {
        return $this->status;
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

    function setDiplome($diplome) {
         parent::setDiplome($diplome);
    }

    function setStatus($status) {
        $this->status = $status;
    }




    
}
