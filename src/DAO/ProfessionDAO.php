<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

use MicroCMS\Domain\Profession;

/**
 * Description of ProfessionDAO
 *
 * @author thouars
 */
class ProfessionDAO extends DAO {

    //put your code here


    public function findAll() {
        $sql = "select * from profession order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $profession = array();
        foreach ($result as $row) {
            $professionId = $row['id'];
            $profession[$professionId] = $this->buildDomainObject($row);
        }
        return $profession;
    }

    public function find($id) {
        $sql = "SELECT profession.id , profession.libelle FROM `profession`, recense WHERE profession.id = recense.idProfession AND recense.id= ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("Aucune profession correspondant à ce recenser " . $id);
            
        }
    }

    public function save(Profession $profession) {
        $professionData = array(
            'id' => $profession->getId(),
            'libelle' => $profession->getLibelle(),
        );

        if ($profession->getId()) {
            // The recense has already been saved : update it
            $this->getDb()->update('profession', $professionData, array('id' => $profession->getId()));
        } else {
            // The recense has never been saved : insert it
            $this->getDb()->insert('profession', $professionData);
            // Get the id of the newly created recense and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $profession->setId($id);
        }
    }

    public function delete($id) {
        // Delete the recense
        $this->getDb()->delete('profession', array('id' => $id));
    }

    /**
     * Creates an Recense object based on a DB row.
     *
     * @param array $row The DB row containing Recense data.
     * @return \MicroCMS\Domain\Recense
     */
    protected function buildDomainObject($row) {
        $profession = new Profession();
        $profession->setId($row['id']);
        $profession->setLibelle($row['libelle']);
        return $profession;
    }


}
