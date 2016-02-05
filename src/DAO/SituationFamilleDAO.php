<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

use MicroCMS\Domain\SituationFamille;

/**
 * Description of SituationFamilleDAO
 *
 * @author thouars
 */
class SituationFamilleDAO extends DAO {

    public function findAll() {
        $sql = "Select * from situationfamilliale order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        $familles = array();
        foreach ($result as $row) {
            $familleId = $row['id'];
            $familles[$familleId] = $this->buildDomaineObject($row);
        }
        return $familles;
    }

    public function find($id) {
        $sql = "SELECT r.id, famille.id, famille.soeurEtFrere, famille.enfantACharge FROM situationfamilliale AS famille, recense AS r WHERE r.id = famille.idrecense  AND r.id = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("Aucune situation familliale correspondant à cette id" . $id);
        }
    }

    public function save(SituationFamille $situationFamilliale) {
        $familleData = array(
            'id' => $situationFamilliale->getId(),
            'soeurEtFrere' => $situationFamilliale->getSoeurEtFrere(),
            'enfant' => $situationFamilliale->getSoeurEtFrere(),
        );

        if ($situationFamilliale->getId()) {
            $this->getDb()->update('situationfamilliale', $familleData, array('id' => $situationFamilliale->getId()));
        } else {
            $this->getDb()->insert('situationfamilliale', $familleData);
            $id = $this->getDb()->lastInsertId();
            $situationFamilliale->setId($id);
        }
    }

    public function delete($id) {
        $this->getDb()->delete('situationfamilliale', array('id' => $id));
    }

    protected function buildDomainObject($row) {
        $famille = new SituationFamille();
        $famille->setId($row['id']);
        $famille->setSoeurEtFrere($row['soeurEtFrere']);
        $famille->setEnfant($row['enfantACharge']);
        return $famille;
    }

}
