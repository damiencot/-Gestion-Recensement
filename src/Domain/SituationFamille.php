<?php



namespace MicroCMS\Domain;

/**
 * Description des Situation de Famille
 *
 * @author thouars
 */
class SituationFamille extends Recense {

    private $id;
    private $soeurEtFrere;
    private $enfantACharge;


    function getIdRecense() {
        return parent::getId();
    }

    function setIdRecense($id) {
        parent::setId($id);
    }

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
