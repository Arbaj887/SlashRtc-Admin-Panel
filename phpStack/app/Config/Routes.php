<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */

//$routes->resource('admin',['namespace'=>'App\Controllers\Admin','controller'=>'AdminController']);
 

$routes->get('/', 'Home::index');
$routes->match(['GET','POST'],'/signup', 'Signup::signup');
$routes->match(['GET','POST'],'/login', 'Login::login');

$routes->match(['GET','POST'], '/logout', 'Logout::logout');
$routes->match(['GET','POST'], '/admin', 'Admin\AdminController::index');
$routes->match(['GET','POST'], '/updateUser', 'Admin\AdminController::updateUser');
$routes->match(['GET','POST'], '/deleteuser/(:any)', 'Admin\AdminController::deleteuser/$1');

$routes->match(['GET','POST'], '/campaign', 'Admin\CampaignController::index');
$routes->match(['GET','POST'], '/campaignupdateUser', 'Admin\CampaignController::updateUser');
$routes->match(['GET','POST'], '/campaigndeleteuser/(:any)', 'Admin\CampaignController::deleteuser/$1');
$routes->match(['GET','POST'], '/addcampaign', 'Admin\CampaignController::addCampaign');

$routes->match(['GET','POST'], '/chat', 'ChatController::index');











