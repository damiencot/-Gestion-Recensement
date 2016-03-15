<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

use MicroCMS\Domain\Recense;

/**
 * Description of RecenseDAO
 *
 * @author thouars
 */
class RecenseDAO extends DAO {

    public function findAll() {
        $sql = "SELECT r.id,r.nom,r.prenom,r.nomUsage,r.dateNaissance,r.adresseMail,r.telephonePortable,r.dateEnregistrement, v.commune FROM recense r INNER JOIN villes v ON r.id = v.id";
        //$sql = "SELECT `id`, `nom`, `prenom`, `nomUsage`, DATE_FORMAT(dateNaissance , '%d/%m/%Y'), `adresseMail`, `telephonePortable`, `idresidence`, `idVilles`, `iddiplome`, DATE_FORMAT(dateEnregistrement, '%d/%m/%Y') FROM `recense` order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $recenses = array();
        foreach ($result as $row) {
            $recenseId = $row['id'];
            $recenses[$recenseId] = $this->buildDomainObjects($row);
        }
        return $recenses;
    }

    public function find($id) {
        //$sql = "SELECT r.id,r.nom,r.prenom,r.nomUsage,r.dateNaissance,r.adresseMail,r.telephonePortable,r.dateEnregistrement, v.commune, re.adresse, d.nom FROM recense r INNER JOIN villes v ON r.id = v.id INNER JOIN residence re ON r.id = re.id INNER JOIN diplome d ON r.id = d.id WHERE r.id = ?";
        // Requete ci-dessus permet de selectionner aussi le champ diplome 
        $sql = "SELECT r.id,r.nom,r.prenom,r.nomUsage,r.dateNaissance,r.adresseMail,r.telephonePortable,r.dateEnregistrement FROM recense AS r WHERE r.id = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No recense matching id " . $id);
        }
    }
    
    public function save(Recense $recense) {
        $recenseData = array(
            'id' => $recense->getId(),
            'nom' => $recense->getNom(),
            'prenom' => $recense->getPrenom(),
            'nomUsage' => $recense->getNomUsage(),
            'dateNaissance' => $recense->getDateNaissance(),
            'adresseMail' => $recense->getAdresseMail(),
            'telephonePortable' => $recense->getTelephonePortable(),
            'dateEnregistrement' => $recense->getDateEnregistrement(),
        );

        if ($recense->getId()) {
// The recense has already been saved : update it
            $this->getDb()->update('recense', $recenseData, array('id' => $recense->getId()));
        } else {
// The recense has never been saved : insert it
            $this->getDb()->insert('recense', $recenseData, array('dateEnregistrement' => $recense->getDateEnregistrementPresent()));
// Get the id of the newly created recense and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $recense->setId($id);
        }
    }

    public function delete($id) {
        // Delete the recense
        $this->getDb()->delete('recense', array('id' => $id));
    }

    /**
     * Creates an Recense object based on a DB row.
     *
     * @param array $row The DB row containing Recense data.
     * @return \MicroCMS\Domain\Recense
     */
    protected function buildDomainObjects($row) {
        $recense = new Recense();
        $recense->setId($row['id']);
        $recense->setNom($row['nom']);
        $recense->setPrenom($row['prenom']);
        $recense->setNomUsage($row['nomUsage']);
        $recense->setDateNaissance($row['dateNaissance']);
        $recense->setAdresseMail($row['adresseMail']);
        $recense->setTelephonePortable($row['telephonePortable']);
        $recense->setDateEnregistrement($row['dateEnregistrement']);
        $recense->setCommune($row['commune']);
        return $recense;
    }

    protected function buildDomainObject($row) {
        $recense = new Recense();
        $recense->setId($row['id']);
        $recense->setNom($row['nom']);
        $recense->setPrenom($row['prenom']);
        $recense->setNomUsage($row['nomUsage']);
        $recense->setDateNaissance($row['dateNaissance']);
        $recense->setAdresseMail($row['adresseMail']);
        $recense->setTelephonePortable($row['telephonePortable']);
        $recense->setDateEnregistrement($row['dateEnregistrement']);


        return $recense;
    }

}
