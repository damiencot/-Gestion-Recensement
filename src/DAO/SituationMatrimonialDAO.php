<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

use MicroCMS\Domain\SituationMatrimonial;

/**
 * Description of SituationFamilleDAO
 *
 * @author thouars
 */
class SituationMatrimonialDAO extends DAO {

    public function findAll() {
        $sql = "Select * from situationmatrimonial order by id desc";
        $result = $this->getDb()->fetchAll($sql);
        $matrimonial= array();
        foreach ($result as $row) {
            $matrimonialId = $row['id'];
            $matrimonial[$matrimonialId] = $this->buildDomaineObject($row);
        }
        return $matrimonial;
    }

    public function find($id) {
        $sql = "SELECT r.id, matrimonial.id, matrimonial.libelle FROM recense AS r, situationmatrimonial AS matrimonial WHERE r.id = matrimonial.id AND r.idMatrimonial = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("Aucune situation matrimonial correspondant à cette id" . $id);
        }
    }

    public function save(SituationMatrimonial $situationmatrimonial) {
        $matrimonalData = array(
            'id' => $situationmatrimonial->getId(),
            'libelle' => $situationmatrimonial->getLibelle(),
        );

        if ($situationmatrimonial->getId()) {
            $this->getDb()->update('situationmatrimonial', $matrimonalData, array('id' => $situationmatrimonial->getId()));
        } else {
            $this->getDb()->insert('situationmatrimonial', $matrimonalData);
            $id = $this->getDb()->lastInsertId();
            $situationmatrimonial->setId($id);
        }
    }
    
   
    
    public function delete($id) {
        $this->getDb()->delete('situationmattrimonial', array('id' => $id));
    }

    protected function buildDomainObject($row) {
        $matrimonial = new SituationMatrimonial();
        $matrimonial->setId($row['id']);
        $matrimonial->setLibelle($row['libelle']);
        return $matrimonial;
    }

}
