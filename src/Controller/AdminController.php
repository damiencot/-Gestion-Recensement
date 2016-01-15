<?php

namespace MicroCMS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\User;
use MicroCMS\Domain\Recense;
use MicroCMS\Form\Type\RecenseType;
use MicroCMS\Form\Type\UserType;

class AdminController {

    /**
     * Admin home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        $recenses = $app['dao.recense']->findAll();
        $users = $app['dao.user']->findAll();
        return $app['twig']->render('admin.html.twig', array(
                    'recenses' => $recenses,
                    'users' => $users));
    }

    /**
     * Add recense controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addRecenseAction(Request $request, Application $app) {
        $recense = new Recense();
        $recenseForm = $app ['formfactory']->create(new RecenseType(), $recense);
        $recenseForm->handleRequest($request);
        if ($recenseForm->isSubmitted() && $recenseForm->Valid()) {
            $app['dao.recense']->save($recense);
            $app['session']->getFlashBag()->add('success', 'the recense was successfully created.');
        }
        return $app['twig']->render('recense_form.html.twig', array(
                    'prenom' => 'New recense',
                    'recenseForm' => $recenseForm->createView()));
        
        
    }

    public function addResidenceAction(Request $request, Application $app) {
        $residence = new Residence();
        $residenceForm = $app['formfactory']->create(new ResidenceType(), $residence);
        $residenceForm->handleRequest($request);
        if ($residenceForm->isSubmitted() && $residenceForm->Valid()) {
            $app['dao.residence']->save($residence);
            $app['session']->getFlashBag()->add('success', ' the residence was successfully created');
        }

        return $app['twig']->render('residence_form.html.twig', array(
                    'adresse' => 'New residence',
                    'residenceForm' => $residenceForm->createView()));
        
    }

    /**
     * Edit recense controller.
     *
     * @param integer $id Recense id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editRecenseAction($id, Request $request, Application $app) {
        $recense = $app['dao.recense']->find($id);
        $recenseForm = $app['form.factory']->create(new RecenseType(), $recense);
        $recenseForm->handleRequest($request);
        if ($recenseForm->isSubmitted() && $recenseForm->isValid()) {
            $app['dao.recense']->save($recense);
            $app['session']->getFlashBag()->add('success', 'The recense was succesfully updated.');
        }
        return $app['twig']->render('recense_form.html.twig', array(
                    'prenom' => 'Edit recensee',
                    'recenseForm' => $recenseForm->createView()));
    }

    public function editResidenceAction($id, Request $request, Application $app) {
        $residence = $app['dao.residence']->find($id);
        $residenceForm = $app['form.factory']->create(new ResidenceType(), $residence);
        $residenceForm->handleRequest($request);
        if ($residenceForm->isSubmitted() && $residenceForm->isValid()) {
            $app['dao.residence']->save($residence);
            $app['session']->getFlashBag()->add('success', 'The residence was succesfully updated.');
        }
        return $app['twig']->render('residence_form.html.twig', array(
                    'adresse' => 'New residence',
                    'residenceForm' => $residenceForm->createView()));
    }

    /**
     * Delete recense controller.
     *
     * @param integer $id Recense id
     * @param Application $app Silex application
     */
    public function deleteRenceseAction($id, Application $app) {
        // Delete the recense
        $app['dao.recense']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The recense was succesfully removed.');
        return $app->redirect('/admin');
    }

    /**
     * Add user controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addUserAction(Request $request, Application $app) {
        $user = new User();
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            // generate a random salt value
            $salt = substr(md5(time()), 0, 23);
            $user->setSalt($salt);
            $plainPassword = $user->getPassword();
            // find the default encoder
            $encoder = $app['security.encoder.digest'];
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
        }
        return $app['twig']->render('user_form.html.twig', array(
                    'title' => 'New user',
                    'userForm' => $userForm->createView()));
    }

    /**
     * Edit user controller.
     *
     * @param integer $id User id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserAction($id, Request $request, Application $app) {
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $plainPassword = $user->getPassword();
            // find the encoder for the user
            $encoder = $app['security.encoder_factory']->getEncoder($user);
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password);
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
        }
        return $app['twig']->render('user_form.html.twig', array(
                    'title' => 'Edit user',
                    'userForm' => $userForm->createView()));
    }

    /**
     * Delete user controller.
     *
     * @param integer $id User id
     * @param Application $app Silex application
     */
    public function deleteUserAction($id, Application $app) {
        // Delete the user
        $app['dao.user']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
        return $app->redirect('/admin');
    }

}
