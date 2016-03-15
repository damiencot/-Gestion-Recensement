<?php



namespace MicroCMS\Domain;

/**
 * Description des Recense
 *
 * @author thouars
 */
class Recense extends Villes {

    private $id;
    private $nom;
    private $prenom;
    private $nomUsage;
    private $dateNaissance;
    private $adresseMail;
    private $telephonePortable;
    private $dateEnregistrement;
    
    private $dateEnregistrementPresent = 'NOW()';

    function getCommune() {
        return parent::getCommune();
    }

    function setCommune($commune) {
        parent::setCommune($commune);
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

    function getDateEnregistrement() {
    /*
        list($annee, $mois, $jour) = explode("-", $this->dateEnregistrement);
        $dateFR = $jour . '/' . $mois . '/' . $annee;

        return $dateFR;
     */
        
 
     return $this->dateEnregistrement;

    }

    function setDateEnregistrement($dateEnregistrement) {
        $this->dateEnregistrement = $dateEnregistrement;
    }
    
    
    function getDateEnregistrementPresent(){
       
        
         return $this->dateEnregistrementPresent;
    }

    

}
