<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of Recense
 *
 * @author thouars
 */
class Recense {
    
    private $id;
   
    private $nom;
    
    private $prenom;
            
    private $nomUsage;
    
    private $dateNaissance;
    
    private $adresseMail;
    
    private $telephonePortable;
    
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getNomUsage() {
        return $this->nomUsage;
    }

    function getDateNaissance() {
        return $this->dateNaissance;
    }

    function getAdresseMail() {
        return $this->adresseMail;
    }

    function getTelephonePortable() {
        return $this->telephonePortable;
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

    function setNomUsage($nomUsage) {
        $this->nomUsage = $nomUsage;
    }

    function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    function setAdresseMail($adresseMail) {
        $this->adresseMail = $adresseMail;
    }

    function setTelephonePortable($telephonePortable) {
        $this->telephonePortable = $telephonePortable;
    }


    
}
