<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of filliationParents
 *
 * @author thouars
 */
class FilliationParent extends Nationalites {

    private $id;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $sexe;

    function getInseePays() {
        parent::getInseePays();
    }

    function getPays() {
        return parent::getPays();
    }

    function setInseePays($inseePays) {
        parent::setInseePays($inseePays);
    }

    function setPays($pays) {
        parent::setPays($pays);
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getDateNaissance() {
        return $this->dateNaissance;
    }

    function getSexe() {
        return $this->sexe;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    function setSexe($sexe) {

        $this->sexe = $sexe;
    }

}
