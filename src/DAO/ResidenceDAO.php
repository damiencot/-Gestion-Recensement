<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

use MicroCMS\Domain\Residence;

/**
 * Description of AdresseDAO
 *
 * @author thouars
 */
class ResidenceDAO extends DAO {
    
    
 
    
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
        //$sql ="select * from residence where id=?";
        $sql = "SELECT recense.id, residence.id , residence.adresse, residence.telephone , villes.id, villes.commune, villes.inseeVille, villes.codePostal FROM recense, residence, villes WHERE recense.idresidence = residence.id AND residence.id = villes.id AND recense.id = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        
        //$this->idvilles = $row['villes.id'];
        
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
            //'idvilles' => $residence->getIdVilles(),
    
            );
        
          //var_dump($residenceData);
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
        $residence->setCommune($row['commune']);
        $residence->setInseeVille($row['inseeVille']);
        $residence->setCodePostal($row['codePostal']);
        return $residence;
    }
}
