<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\DAO;

/**
 * Description of search
 *
 * @author thouars
 */
class search {

    function autocomplete() {

 
        if (isset($_GET['query'])) {
            // Mot tapé par l'utilisateur
            $q = htmlentities($_GET['query']);


            // Requête SQL
            $requete = "SELECT * FROM langages WHERE nom LIKE '" . $q . "%' LIMIT 0, 10";


            $resultat = $this->getDb()->fetchAll($requete);
            
            // On parcourt les résultats de la requête SQL
            while ($resultat) {
                // On ajoute les données dans un tableau
                $suggestions['suggestions'][] = $resultat['nom'];
            }

            // On renvoie le données au format JSON pour le plugin
            echo json_encode($suggestions);
        }
    }

}
