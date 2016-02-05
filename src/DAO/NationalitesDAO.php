<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

use MicroCMS\Domain\Nationalites;

/**
 * Description of NationalitesDAO
 *
 * @author thouars
 */
class NationalitesDAO extends DAO {

    public function findAll() {
        $sql = "select * from nationalites order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $nationalites = array();
        foreach ($result as $row) {
            $nationalitesId = $row['id'];
            $nationalites[$nationalitesId] = $this->buildDomainObject($row);
        }
        return $nationalites;
    }

    public function find($id) {
        $sql = "SELECT recense.id, recense.idNationalitesDeux, nationalites.pays, nationalites.inseePays FROM recense, nationalites WHERE recense.idNationalites = nationalites.id AND recense.id = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No nationalites matching id " . $id);
        }
    }

    public function save(nationalites $nationalites) {
        $nationalitesData = array(
            'id' => $nationalites->getId(),
            'pays' => $nationalites->getPays(),
            'inseePays' => $nationalites->getInseePays(),);

        if ($nationalites->getId()) {
            // The recense has already been saved : update it
            $this->getDb()->update('nationalites', $nationalitesData, array('id' => $nationalites->getId()));
        } else {
            // The recense has never been saved : insert it
            $this->getDb()->insert('nationalites', $nationalitesData);
            // Get the id of the newly created recense and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $nationalites->setId($id);
        }
    }

    public function delete($id) {
        // Delete the recense
        $this->getDb()->delete('nationalites', array('id' => $id));
    }

    /**
     * Creates an Recense object based on a DB row.
     *
     * @param array $row The DB row containing Recense data.
     * @return \MicroCMS\Domain\Recense
     */
    protected function buildDomainObject($row) {
        $nationalites = new Nationalites();
        $nationalites->setId($row['id']);
        $nationalites->setPays($row['pays']);
        $nationalites->setInseePays($row['inseePays']);
        return $nationalites;
    }

}
