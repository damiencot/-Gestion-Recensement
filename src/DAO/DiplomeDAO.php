<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;


use MicroCMS\Domain\Diplome;
/**
 * Description des functions Recenses
 *
 * @author thouars
 */
class DiplomeDAO  extends DAO{

      /*
       * Recherche génèral de tout les diplomes
       */
      public function findAll() {
        $sql = "select * from diplome order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convertie le résultas de la requête en tableau 
        $diplomes = array();
        foreach ($result as $row) {
            $diplomeId = $row['id'];
            $diplomes[$diplomeId] = $this->buildDomainObject($row);
        }
        return $diplomes;
    }
    
    /*
     * Recherche des diplomes correspondant au recensé
     */
    public function find($id) {
        $sql = "select * from diplome where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No diplome matching id " . $id);
        }
    }
    
    /*
     * Sauvegarde du diplome correspondant aux recensé
     */
    public function save(Diplome $diplome) {
        $diplomeData = array(
            'id' => $diplome->getId(),
            'diplome' => $diplome->getDiplome(),
            );

        if ($diplome->getId()) {
            // Le diplome correspondant aux recensé est déjà enregistré donc on le met à jour.
            $this->getDb()->update('diplome', $diplomeData, array('id' => $diplome->getId()));
        } else {
            // Le recensé n'a aucun diplome qui lui est liée donc on le crée
            $this->getDb()->insert('diplome', $diplomeData);
            
            // Obtenir l'ID du Recense nouvellement créé et mis sur l'entité .
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
        $diplome->setDiplome($row['diplome']);
        return $diplome;
    }
}
