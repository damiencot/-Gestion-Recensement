<?php

// Home page
$app->get('/', "MicroCMS\Controller\HomeController::indexAction");

// Admin zone
$app->get('/admin/', "MicroCMS\Controller\AdminController::indexAction");

// Detailed info about an recense
//$app->match('/article/{id}', "MicroCMS\Controller\HomeController::articleAction");
$app->match('/recense/{id}', "MicroCMS\Controller\HomeController::recenseAction");

// Add a new recense
$app->match('/admin/recense/add', "MicroCMS\Controller\AdminController::addRecenseAction");

// Edit an existing recense
$app->match('/admin/recense/{id}/edit', "MicroCMS\Controller\AdminController::editRecenseAction");

// Remove an recense
$app->get('/admin/recense/{id}/delete', "MicroCMS\Controller\AdminController::deleteRecenseAction");

// Login form
$app->get('/login', "MicroCMS\Controller\HomeController::loginAction")
->bind('login');  // named route so that path('login') works in Twig templates

// Add a user
$app->match('/admin/user/add', "MicroCMS\Controller\AdminController::addUserAction");

// Edit an existing user
$app->match('/admin/user/{id}/edit', "MicroCMS\Controller\AdminController::editUserAction");

// Remove a user
$app->get('/admin/user/{id}/delete', "MicroCMS\Controller\AdminController::deleteUserAction");

// API : get all recense
$app->get('/api/recenses', "MicroCMS\Controller\ApiController::getRecencesAction");

// API : get an recense
$app->get('/api/recense/{id}', "MicroCMS\Controller\ApiController::getRecenseAction");

// API : create an recense
$app->post('/api/recense', "MicroCMS\Controller\ApiController::addRecenseAction");

// API : remove an recense
$app->delete('/api/recense/{id}', "MicroCMS\Controller\ApiController::deleteRecenseAction");

