<?php

namespace MicroCMS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {

    /*
     * Home page controller.
     *
     * @param Application $app Silex application
     */
    

    public function indexAction(Application $app) {
        $recenses = $app['dao.recense']->findAll();
        return $app['twig']->render('index.html.twig', array('recenses' => $recenses));
    }

    /**
     * User login controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function loginAction(Request $request, Application $app) {
        return $app['twig']->render('login.html.twig', array(
                    'error' => $app['security.last_error']($request),
                    'last_username' => $app['session']->get('_security.last_username'),
        ));

    }
    
    public function accueilAction(Request $request, Application $app) {

          $recenses = $app['dao.recense']->findAll();
        return $app['twig']->render('admin.html.twig', array(
                    'recenses' => $recenses));
    }
    


}
