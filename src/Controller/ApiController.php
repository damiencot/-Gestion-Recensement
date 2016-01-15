<?php

namespace MicroCMS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\Recense;

class ApiController {

    /**
     * API recenses controller.
     *
     * @param Application $app Silex application
     *
     * @return All recense in JSON format
     */
    public function getRecensesAction(Application $app) {
        $recenses = $app['dao.recense']->findAll();
        // Convert an array of objects ($recense) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($recenses as $recense) {
            $responseData[] = $this->buildRecenseArray($recense);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API recense details controller.
     *
     * @param integer $id Recense id
     * @param Application $app Silex application
     *
     * @return Recense details in JSON format
     */
    public function getRecenseAction($id, Application $app) {
        $recense = $app['dao.recense']->find($id);
        $responseData = $this->buildRecenseArray($recense);
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API create recense controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     *
     * @return recense details in JSON format
     */
    public function addRecenseAction(Request $request, Application $app) {
        // Check request parameters
        if (!$request->request->has('nom')) {
            return $app->json('Missing required parameter: nom', 400);
        }
        if (!$request->request->has('prenom')) {
            return $app->json('Missing required parameter: prenom', 400);
        }
        // Build and save the new recense
        $recense = new Recense();
        $recense->setNom($request->request->get('nom'));
        $recense->setPrenom($request->request->get('prenom'));
        $recense->setNomUsage($request->request->get('nomUsage'));
        $recense->setDateNaissance($request->request->get('dateNaissance'));
        $recense->setAdresseMail($request->request->get('adresseMail'));
        $recense->setTelephonePortable($request->request->get('telephonePortable'));
        $app['dao.recense']->save($recense);
        $responseData = $this->buildRecenseArray($recense);
        return $app->json($responseData, 201);  // 201 = Created
    }

    /**
     * API delete recense controller.
     *
     * @param integer $id recense id
     * @param Application $app Silex application
     */
    public function deleteRecenseAction($id, Application $app) {
        // Delete the recense
        $app['dao.recense']->delete($id);
        return $app->json('No Content', 204);  // 204 = No content
    }
    
    
    /**
     * Converts an Recense object into an associative array for JSON encoding
     *
     * @param Recense $recense Recense object
     *
     * @return array Associative array whose fields are the recense properties.
     */
    private function buildRecenseArray(Recense $recense) {
        $data  = array(
            'id' => $recense->getId(),
            'nom' => $recense->getNom(),
            'prenom' => $recense->getPrenom(),
            'nomUsage' => $recense->getNomUsage(),
            'dateNaissance' => $recense->getDateNaissance(),
            'adresseMail' => $recense->getAdresseMail(),
            'telephonePortable' => $recense->getTelephonePortable()
                            
            );
        return $data;
    }
    
    
    private function buildResidenceArray(Residence $residence) {
       $date = array (
           'id' => $residence->getId(),
           'adresse' => $residence->getAdresse(),
           'telephone' => $residence->getTelephone()
       );
       return $date;
    }
    
  
}
