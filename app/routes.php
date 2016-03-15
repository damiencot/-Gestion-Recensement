<?php

// Page d accueil
$app->get('/', "MicroCMS\Controller\HomeController::loginAction");

// Zone home
$app->get('/home/', "MicroCMS\Controller\HomeController::indexAccueilAction");

// Informations détaillées sur un Recense
$app->match('/recense/{id}', "MicroCMS\Controller\HomeController::recenseAction");

// Ajouté nouveau Recense
$app->match('home/recense/add', "MicroCMS\Controller\HomeController::addRecenseAction");

// Editer un recense
$app->match('home/recense/{id}/edit', "MicroCMS\Controller\HomeController::editRecenseAction");

// Supprimer un recense
$app->get('home/recense/{id}/delete', "MicroCMS\Controller\HomeController::deleteRecenseAction");

// Page d'authentification
$app->get('/login', "MicroCMS\Controller\HomeController::loginAction")->bind('login');  
// named route so that path ('login') fonctionne dans les modèles Twig
//nommé parcours de façon à ce chemin ( « login» ) fonctionne dans les modèles Twig

// Ajout d'un utilisateur
$app->match('home/user/add', "MicroCMS\Controller\HomeController::addUserAction");

// Editer un utilisateur
$app->match('home/user/{id}/edit', "MicroCMS\Controller\HomeController::editUserAction");

// Supprimer un utilisateur
$app->get('home/user/{id}/delete', "MicroCMS\Controller\HomeController::deleteUserAction");

// API : recupere tout les recense
$app->get('/api/recenses', "MicroCMS\Controller\ApiController::getRecencesAction");

// API : recupere un recense precis
$app->get('/api/recense/{id}', "MicroCMS\Controller\ApiController::getRecenseAction");

// API : crée un recense
$app->post('/api/recense', "MicroCMS\Controller\ApiController::addRecenseAction");

// API : supprimer un recense
$app->delete('/api/recense/{id}', "MicroCMS\Controller\ApiController::deleteRecenseAction");


