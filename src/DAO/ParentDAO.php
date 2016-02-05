<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

/**
 * Description of ParentDAO
 *
 * @author thouars
 */
class ParentDAO extends DAO{
    //put your code here
    
    
      public function findAll() {
        $sql = "select * from filliationparents order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $parent = array();
        foreach ($result as $row) {
            $parentId = $row['id'];
            $parent[$parentId] = $this->buildDomainObject($row);
        }
        return $parent;
    }
    
    
     public function find($id) {
        //$sql="SELECT * FROM villes WHERE id =(SELECT id FROM recense WHERE idVilles = ?)";
        //Selection toute les villes qui correspondans aux ID des différents recense.
        //$sql = "SELECT r.id, v.commune FROM recense r INNER JOIN villes v ON r.id = v.id ";
        $sql ="SELECT recense.id, filliationparents.nom, filliationparents.prenom, filliationparents.dateNaissance, filliationparents.sexe, filliationparents.idNationalites , nationalites.pays FROM recense, filliationparents, nationalites WHERE recense.id = filliationparents.id AND filliationparents.id = nationalites.id AND idrecense = ?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No filliation parent matching id " . $id);
        }
    }
    
    
    public function save(Parents $parents) {
        $parentsData = array(
            'id' => $parents->getId(),
            'nom' => $parents->getNom(),
            'prenom' => $parents->getPrenom(),
            'dateNaissance' => $parents->getDateNaissance(),
            'sexe' => $parents->getSexe(),
            );

        if ($parents->getId()) {
            // The recense has already been saved : update it
            $this->getDb()->update('parent', $parentsData, array('id' => $parents->getId()));
        } else {
            // The recense has never been saved : insert it
            $this->getDb()->insert('parent', $parentsData);
            // Get the id of the newly created recense and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $parents->setId($id);
        }
    }
    
     public function delete($id) {
        // Delete the recense
        $this->getDb()->delete('parent', array('id' => $id));
    }

    
    
    /**
     * Creates an Recense object based on a DB row.
     *
     * @param array $row The DB row containing Recense data.
     * @return \MicroCMS\Domain\Recense
     */
    protected function buildDomainObject($row) {
        $parent = new Parents();
        $parent->setId($row['id']);
        $parent->setNom($row['nom']);
        $parent->setPrenom($row['prenom']);
        $parent->setDateNaissance($row['dateNaissance']);
        $parent->setSexe($row['sexe']);
        return $parent;
    }
}
