<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;


use MicroCMS\Domain\Villes;
/**
 * Description of RecenseDAO
 *
 * @author thouars
 */
class VillesDAO  extends DAO{
    //put your code here
    
    
      public function findAll() {
        $sql = "select * from villes order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $villes = array();
        foreach ($result as $row) {
            $villeId = $row['id'];
            $villes[$villeId] = $this->buildDomainObject($row);
        }
        return $villes;
    }
    
    
     public function find($id) {
        $sql = "select * from villes where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No villes matching id " . $id);
        }
    }
    
    
    public function save(Villes $ville) {
        $villeData = array(
            'id' => $ville->getId(),
            'inseeVille' => $ville->getInseeVille(),
            'nom' => $ville->getNom(),
            'codePostal' => $ville->getCodePostal(),
            );

        if ($ville->getId()) {
            // The recense has already been saved : update it
            $this->getDb()->update('ville', $villeData, array('id' => $ville->getId()));
        } else {
            // The recense has never been saved : insert it
            $this->getDb()->insert('ville', $villeData);
            // Get the id of the newly created recense and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $ville->setId($id);
        }
    }
    
     public function delete($id) {
        // Delete the recense
        $this->getDb()->delete('ville', array('id' => $id));
    }

    /**
     * Creates an Recense object based on a DB row.
     *
     * @param array $row The DB row containing Recense data.
     * @return \MicroCMS\Domain\Recense
     */
    protected function buildDomainObject($row) {
        $ville = new Ville();
        $ville->setId($row['id']);
        $ville->setInseeVille($row['inseeVille']);
        $ville->setNom($row['nom']);
        $ville->setCodePostal($row['codePostal']);
        return $ville;
    }
}
