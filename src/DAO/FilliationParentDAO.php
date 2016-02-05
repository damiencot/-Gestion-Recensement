<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

use MicroCMS\Domain\FilliationParent;

/**
 * Description of filliationParentDAO
 *
 * @author thouars
 */
class FilliationParentDAO extends DAO {

    //put your code here


    public function findAll() {
        $sql = "select * from filliationfilliationParents order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $filliationParent = array();
        foreach ($result as $row) {
            $filliationParentId = $row['id'];
            $filliationParent[$filliationParentId] = $this->buildDomainObject($row);
        }
        return $filliationParent;
    }

    public function findFather($id) {
        $sql = "SELECT recense.id, filliationParents.nom, filliationParents.prenom, filliationParents.dateNaissance, filliationParents.sexe, filliationParents.idNationalites , nationalites.pays FROM recense, filliationParents, nationalites WHERE recense.id = filliationParents.idrecense AND filliationParents.idNationalites = nationalites.id AND filliationParents.sexe = 1 AND idrecense = ?";
        //$sql = "SELECT recense.id, filliationParents.nom, filliationParents.prenom, filliationParents.dateNaissance, filliationParents.sexe, filliationParents.idNationalites , nationalites.pays FROM recense, filliationParents, nationalites WHERE recense.id = filliationParents.id AND filliationParents.idNationalites = nationalites.id AND filliationParents.sexe = 1 AND idrecense = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No filliationParent matching id " . $id);
        }
    }

    public function findMother($id) {
        $sql = "SELECT recense.id, filliationParents.nom, filliationParents.prenom, filliationParents.dateNaissance, filliationParents.sexe, filliationParents.idNationalites , nationalites.pays FROM recense, filliationParents, nationalites WHERE recense.id = filliationParents.idrecense AND filliationParents.idNationalites = nationalites.id AND filliationParents.sexe = 0 AND idrecense = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No filliationParent matching id " . $id);
        }
    }

    public function save(filliationParents $filliationParents) {
        $filliationParentsData = array(
            'id' => $filliationParents->getId(),
            'nom' => $filliationParents->getNom(),
            'prenom' => $filliationParents->getPrenom(),
            'dateNaissance' => $filliationParents->getDateNaissance(),
            'sexe' => $filliationParents->getSexe(),
        );

        if ($filliationParents->getId()) {
            // The recense has already been saved : update it
            $this->getDb()->update('filliationParents', $filliationParentsData, array('id' => $filliationParents->getId()));
        } else {
            // The recense has never been saved : insert it
            $this->getDb()->insert('filliationParents', $filliationParentsData);
            // Get the id of the newly created recense and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $filliationParents->setId($id);
        }
    }

    public function delete($id) {
        // Delete the recense
        $this->getDb()->delete('filliationParents', array('id' => $id));
    }

    /**
     * Creates an Recense object based on a DB row.
     *
     * @param array $row The DB row containing Recense data.
     * @return \MicroCMS\Domain\Recense
     */
    protected function buildDomainObject($row) {
        $filliationParents = new FilliationParent();
        $filliationParents->setId($row['id']);
        $filliationParents->setNom($row['nom']);
        $filliationParents->setPrenom($row['prenom']);
        $filliationParents->setDateNaissance($row['dateNaissance']);
        $filliationParents->setSexe($row['sexe']);
        $filliationParents->setPays($row['pays']);
        return $filliationParents;
    }

}
