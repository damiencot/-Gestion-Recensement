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
    
    private $dateEnregistrement;
    
    private $commune;
    
    private $diplome;
    
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

    /*
     * 
     * $date = new DateTime();
        return $date->format('Y-m-d');
     */
    
    
    
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

    function getDateEnregistrement() {
        return $this->dateEnregistrement;
    }

    function setDateEnregistrement($dateEnregistrement) {
        $this->dateEnregistrement = $dateEnregistrement;
    }

    function getCommune() {
        return $this->commune;
    }

    function setCommune($commune) {
        $this->commune = $commune;
    }

    function getDiplome() {
        return $this->diplome;
    }

    function setDiplome($diplome) {
        $this->diplome = $diplome;
    }


}
