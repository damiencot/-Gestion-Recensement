<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

/**
 * Description of AdresseDAO
 *
 * @author thouars
 */
class ResidenceDAO {
    
    public function findAll() {
        $sql = "select * from residence order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $residences = array();
        foreach ($result as $row) {
            $residenceId = $row['id'];
            $residences[$residenceId] = $this->buildDomainObject($row);
        }
        return $residences;
    }
    
    
     public function find($id) {
        $sql = "select * from residence where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No residence matching id " . $id);
        }
    }
    
    
    public function save(Residence $residence) {
        $residenceData = array(
            'id' => $residence->getId(),
            'adresse' => $residence->getAdresse(),
            'telephone' => $residence->getTelephone(),
            );

        if ($residence->getId()) {
            // The residence has already been saved : update it
            $this->getDb()->update('residence', $residenceData, array('id' => $residence->getId()));
        } else {
            // The residence has never been saved : insert it
            $this->getDb()->insert('residence', $residenceData);
            // Get the id of the newly created residence and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $residence->setId($id);
        }
    }
    
     public function delete($id) {
        // Delete the residence
        $this->getDb()->delete('residence', array('id' => $id));
    }

    /**
     * Creates an residence object based on a DB row.
     *
     * @param array $row The DB row containing residence data.
     * @return \MicroCMS\Domain\residence
     */
    protected function buildDomainObject($row) {
        $residence = new Residence();
        $residence->setId($row['id']);
        $residence->setAdresse($row['adresse']);
        $residence->setTelephone($row['telephone']);
        return $residence;
    }
}
