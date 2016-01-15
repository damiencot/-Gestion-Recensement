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

    //put your code here


    public function findAll() {
        $sql = "select * from recense order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $recenses = array();
        foreach ($result as $row) {
            $recenseId = $row['id'];
            $recenses[$recenseId] = $this->buildDomainObject($row);
        }
        return $recenses;
    }

    public function find($id) {
        $sql = "select * from recense where id=?";
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
        );

        if ($recense->getId()) {
            // The recense has already been saved : update it
            $this->getDb()->update('recense', $recenseData, array('id' => $recense->getId()));
        } else {
            // The recense has never been saved : insert it
            $this->getDb()->insert('recense', $recenseData);
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
    protected function buildDomainObject($row) {
        $recense = new Recense();
        $recense->setId($row['id']);
        $recense->setNom($row['nom']);
        $recense->setPrenom($row['prenom']);
        $recense->setNomUsage($row['nomUsage']);
        $recense->setDateNaissance($row['dateNaissance']);
        $recense->setAdresseMail($row['adresseMail']);
        $recense->setTelephonePortable($row['telephonePortable']);
        return $recense;
    }

}
