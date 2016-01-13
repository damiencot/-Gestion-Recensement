<?php

namespace MicroCMS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\Article;
use MicroCMS\Domain\User;
use MicroCMS\Domain\Recense;
use MicroCMS\Form\Type\RecenseType;
use MicroCMS\Form\Type\ArticleType;
use MicroCMS\Form\Type\UserType;

class AdminController {

    /**
     * Admin home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
        //$articles = $app['dao.article']->findAll();
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
    public function addRecenseAction(Request $request, Application $app)    {
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
     * Add article controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addArticleAction(Request $request, Application $app) {
        $article = new Article();
        $articleForm = $app['form.factory']->create(new ArticleType(), $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
        }
        return $app['twig']->render('article_form.html.twig', array(
            'title' => 'New article',
            'articleForm' => $articleForm->createView()));
    }
    

    /**
     * Edit article controller.
     *
     * @param integer $id Article id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editArticleAction($id, Request $request, Application $app) {
        $article = $app['dao.article']->find($id);
        $articleForm = $app['form.factory']->create(new ArticleType(), $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $app['dao.article']->save($article);
            $app['session']->getFlashBag()->add('success', 'The article was succesfully updated.');
        }
        return $app['twig']->render('article_form.html.twig', array(
            'title' => 'Edit article',
            'articleForm' => $articleForm->createView()));
    }

    
    /**
     * Delete article controller.
     *
     * @param integer $id Article id
     * @param Application $app Silex application
     */
    public function deleteArticleAction($id, Application $app) {
        // Delete the article
        $app['dao.article']->delete($id);
        $app['session']->getFlashBag()->add('success', 'The article was succesfully removed.');
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
