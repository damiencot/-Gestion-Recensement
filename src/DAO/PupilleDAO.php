<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;


use MicroCMS\Domain\Pupille;
/**
 * Description of RecenseDAO
 *
 * @author thouars
 */
class PupilleDAO  extends DAO{
    //put your code here
    
    
      public function findAll() {
        $sql = "select * from pupille order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $diplomes = array();
        foreach ($result as $row) {
            $diplomeId = $row['id'];
            $diplomes[$diplomeId] = $this->buildDomainObject($row);
        }
        return $diplomes;
    }
    
    
     public function find($id) {
        $sql = "select * from diplome where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No diplome matching id " . $id);
        }
    }
    
    
    public function save(Diplome $diplome) {
        $diplomeData = array(
            'id' => $diplome->getId(),
            'nature' => $diplome->getNom(),
            );

        if ($diplome->getId()) {
            // The recense has already been saved : update it
            $this->getDb()->update('diplome', $diplomeData, array('id' => $diplome->getId()));
        } else {
            // The recense has never been saved : insert it
            $this->getDb()->insert('diplome', $diplomeData);
            // Get the id of the newly created recense and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $diplome->setId($id);
        }
    }
    
     public function delete($id) {
        // Delete the recense
        $this->getDb()->delete('diplome', array('id' => $id));
    }

    /**
     * Creates an Recense object based on a DB row.
     *
     * @param array $row The DB row containing Recense data.
     * @return \MicroCMS\Domain\Recense
     */
    protected function buildDomainObject($row) {
        $diplome = new Diplome();
        $diplome->setId($row['id']);
        $diplome->setNature($row['nature']);
        return $diplome;
    }
}
