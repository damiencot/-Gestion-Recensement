<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

use MicroCMS\Domain\SituationScolaire;

/**
 * Description of NationalitesDAO
 *
 * @author thouars
 */
class SituationScolaireDAO extends DAO {

    public function findAll() {
        $sql = "select * from situationscolaire order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $situationscolaire = array();
        foreach ($result as $row) {
            $situationscolaireId = $row['id'];
            $situationscolaire[$situationscolaireId] = $this->buildDomainObject($row);
        }
        return $situationscolaire;
    }

    public function find($id) {
        $sql = "SELECT recense.id, situationscolaire.etude, situationscolaire.specialites, diplome.diplome FROM recense, situationscolaire, diplome WHERE situationscolaire.id = recense.idSituationScolaire AND recense.iddiplome = diplome.id AND recense.id = ?";
        //$sql = "SELECT recense.id, situationscolaire.etude, situationscolaire.specialites, diplome.diplome FROM recense, situationscolaire, diplome WHERE recense.idSituationScolaire = situationscolaire.id AND recense.iddiplome = diplome.id AND recense.id = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));
        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No situation scolaire matching id " . $id);
        }
    }

    public function save(SituationScolaire $situationscolaire) {
        $situationscolaireData = array(
            'id' => $situationscolaire->getId(),
            'etude' => $situationscolaire->getEtude(),
            'specialites' => $situationscolaire->getSpecialites()
        );

        if ($situationscolaire->getId()) {
            // The recense has already been saved : update it
            $this->getDb()->update('situationscolaire', $situationscolaireData, array('id' => $situationscolaire->getId()));
        } else {
            // The recense has never been saved : insert it
            $this->getDb()->insert('situationscolaire', $situationscolaireData);
            // Get the id of the newly created recense and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $situationscolaire->setId($id);
        }
    }

    public function delete($id) {
        // Delete the recense
        $this->getDb()->delete('situationscolaire', array('id' => $id));
    }

    /**
     * Creates an Recense object based on a DB row.
     *
     * @param array $row The DB row containing Recense data.
     * @return \MicroCMS\Domain\Recense
     */
    protected function buildDomainObject($row) {
        $situationscolaire = new SituationScolaire();
        $situationscolaire->setId($row['id']);
        $situationscolaire->setEtude($row['etude']);
        $situationscolaire->setSpecialites($row['specialites']);
        $situationscolaire->setDiplome($row['diplome']);
        return $situationscolaire;
    }

}
