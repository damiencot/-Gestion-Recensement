<?php

namespace MicroCMS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use MicroCMS\Domain\User;
use MicroCMS\Domain\Recense;
use MicroCMS\Domain\Residence;
use MicroCMS\Domain\FilliationParent;
use MicroCMS\Domain\SituationFamille;
use MicroCMS\Domain\Nationalites;
use MicroCMS\Domain\SituationScolaire;
use MicroCMS\Domain\Profession;
use MicroCMS\Form\Type\SituationScolaireType;
use MicroCMS\Form\Type\NationalitesType;
use MicroCMS\Form\Type\SituationFamilleType;
use MicroCMS\Form\Type\RecenseType;
use MicroCMS\Form\Type\FilliationParentType;
use MicroCMS\Form\Type\ResidenceType;
use MicroCMS\Form\Type\ProfessionType;
use MicroCMS\Form\Type\UserType;

class AdminController {

    /**
     * Admin home page co
     * @param Application $appcontroller.
     * Silex application
     */
    public function indexAction(Application $app) {
        $recenses = $app['dao.recense']->findAll();
        return $app['twig']->render('admin.html.twig', array(
                    'recenses' => $recenses));
    }

    /**
     * Add recense controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function addRecenseAction(Request $request, Application $app) {

        $recense = new Recense();
        $recenseForm = $app ['form.factory']->create(new RecenseType(), $recense);
        $recenseForm->handleRequest($request);

        $residence = new Residence();
        $residenceForm = $app['form.factory']->create(new ResidenceType(), $residence);
        $residenceForm->handleRequest($request);

        $filliationParent = new FilliationParent();
        $filliationParentForm = $app['form.factory']->create(new FilliationParentType(), $filliationParent);
        $filliationParentForm->handleRequest($request);

        $infoComplementaire = new SituationFamille();
        $infoComplementaireForm = $app['form.factory']->create(new SituationFamilleType(), $infoComplementaire);
        $infoComplementaireForm->handleRequest($request);

        $nationalites = new Nationalites();
        $nationalitesForm = $app['form.factory']->create(new NationalitesType(), $nationalites);
        $nationalitesForm->handleRequest($request);

        $scolaire = new SituationScolaire();
        $scolaireForm = $app['form.factory']->create(new SituationScolaireType(), $scolaire);
        $scolaireForm->handleRequest($request);

        $profession = new Profession();
        $professionForm = $app['form.factory']->create(new ProfessionType(), $profession);
        $professionForm->handleRequest($request);


        if ($recenseForm->isSubmitted() || $professionForm->isSubmitted() || $residenceForm->isSubmitted() || $infoComplementaireForm->isSubmitted() || $scolaireForm->isSubmitted() /* ||  $filliationMere->isSubmitted() || $filliationPere->isSubmitted() *//* || $residenceForm->isValid() */) {
            $app['dao.recense']->save($recense);
            $app['session']->getFlashBag()->add('success', 'the recense was successfully created.');
        }
        return $app['twig']->render('recense_form.html.twig', array(
                    'prenom' => 'New recense',
                    'recenseForm' => $recenseForm->createView(),
                    //'nationalites' => $nationalitesForm->createView(),
                    'professionForm' => $professionForm->createView(),
                    'infoComplementaireForm' => $infoComplementaireForm->createView(),
                    //'filliationPereForm' => $filliationParentForm->createView(),
                    //'filliationMereForm' => $filliationParentForm->createView(),
                    'residenceForm' => $residenceForm->createView(),
                    'scolaireForm' => $scolaireForm->createView(),
                    'nationalitesForm' => $nationalitesForm->createView()));
    }

    /**
     * Edit recense controller.
     *
     * @param integer $id Recense id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     * 
     */
    public function editRecenseAction($id, Request $request, Application $app) {


        $recense = $app['dao.recense']->find($id);
        $recenseForm = $app['form.factory']->create(new RecenseType(), $recense);
        $recenseForm->handleRequest($request);

        $residence = $app['dao.residence']->find($id);
        $residenceForm = $app['form.factory']->create(new ResidenceType(), $residence);
        $residenceForm->handleRequest($request);

        $filliationMere = $app['dao.filliationParent']->findMother($id);
        $filliationMereForm = $app['form.factory']->create(new FilliationParentType(), $filliationMere);
        $filliationMereForm->handleRequest($request);

        $filliationPere = $app['dao.filliationParent']->findFather($id);
        $filliationPereForm = $app['form.factory']->create(new FilliationParentType(), $filliationPere);
        $filliationPereForm->handleRequest($request);

        $infoComplementaire = $app['dao.situationFamille']->find($id);
        $infoComplementaireForm = $app['form.factory']->create(new SituationFamilleType(), $infoComplementaire);
        $infoComplementaireForm->handleRequest($request);

        $nationalites = $app['dao.nationalites']->find($id);
        $nationalitesForm = $app['form.factory']->create(new NationalitesType(), $nationalites);
        $nationalitesForm->handleRequest($request);

        $scolaire = $app['dao.situationScolaire']->find($id);
        $scolaireForm = $app['form.factory']->create(new SituationScolaireType(), $scolaire);
        $scolaireForm->handleRequest($request);

        $profession = $app['dao.profession']->find($id);
        $professionForm = $app['form.factory']->create(new ProfessionType(), $profession);
        $professionForm->handleRequest($request);


        if ($recenseForm->isSubmitted() || $professionForm->isSubmitted() || $residenceForm->isSubmitted() || $infoComplementaireForm->isSubmitted() || $scolaireForm->isSubmitted() /* ||  $filliationMere->isSubmitted() || $filliationPere->isSubmitted() *//* || $residenceForm->isValid() */) {
            $app['dao.situationFamille']->save($infoComplementaire);
            //$app['dao.nationalites']->save($nationalitesForm);
            $app['dao.residence']->save($residence);
            $app['dao.recense']->save($recense);
            //$app['dao.filliationParent']->save($filliationMere);
            //$app['dao.filliationParent']->save($filliationPere);
            $app['dao.situationScolaire']->save($scolaire);
            $app['dao.profession']->save($profession);
            $app['session']->getFlashBag()->add('success', 'Le recense à bien étais mis à jour.');
        }
        return $app['twig']->render('recense_form.html.twig', array(
                    'prenom' => 'Edit recensee',
                    'nationalites' => $nationalitesForm->createView(),
                    'professionForm' => $professionForm->createView(),
                    'infoComplementaireForm' => $infoComplementaireForm->createView(),
                    'filliationPereForm' => $filliationPereForm->createView(),
                    'filliationMereForm' => $filliationMereForm->createView(),
                    'residenceForm' => $residenceForm->createView(),
                    'scolaireForm' => $scolaireForm->createView(),
                    'recenseForm' => $recenseForm->createView(),
                    'nationalitesForm' => $nationalitesForm->createView()));
    }

    /**
     * Suppression recense controller.
     *
     * @param integer $id Recense id
     * @param Application $app Silex application
     */
    public function deleteRecenseAction($id, Application $app) {
        // Delete the recense
        $app['dao.recense']->delete($id);
        $app['session']->getFlashBag()->add('success', 'Le recense à bien étais supprimer.');
        //return $app->redirect('/admin/');
        return $this->indexAction($app);
    }

    /**
     * Add user controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application

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
     */

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

}
