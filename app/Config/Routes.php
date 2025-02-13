<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['get','post'],'/logout'                         , 'Home::logout');
$routes->match(['get','post'],'/signIN'   ,                     'Login\LoginController::signIn');
$routes->match(['get','post'],'/adminDashboard'                 , 'Dashboard\DashboardController::adminDashboard');

$routes->match(['get','post'],'/Admin-Vendor'                     , 'AdminMaster\MasterController::Vendor');
$routes->match(['get','post'],'/Admin-AddVendor'                  , 'AdminMaster\MasterController::AddVendor');
$routes->match(['get','post'],'/Admin-store_Vendor'                     , 'AdminMaster\MasterController::store_Vendor');
$routes->match(['get','post'],'/Admin-updateVendor'                     , 'AdminMaster\MasterController::updateVendor');
$routes->match(['get','post'],'/Admin-deleteRec'                      , 'AdminMaster\MasterController::deleteRec');

$routes->match(['get','post'],'/Admin-Customer'                     , 'AdminMaster\MasterController::Customer');
$routes->match(['get','post'],'/Admin-AddCustomer'                  , 'AdminMaster\MasterController::AddCustomer');
$routes->match(['get','post'],'/Admin-store_Customer'                     , 'AdminMaster\MasterController::store_Customer');
$routes->match(['get','post'],'/Admin-updateCustomer'                     , 'AdminMaster\MasterController::updateCustomer');

$routes->match(['get','post'],'/Admin-Products'                     , 'AdminMaster\MasterController::Products');
$routes->match(['get','post'],'/Admin-AddProducts'                  , 'AdminMaster\MasterController::AddProducts');
$routes->match(['get','post'],'/Admin-store_Products'                     , 'AdminMaster\MasterController::store_Products');
$routes->match(['get','post'],'/Admin-updateProducts'                     , 'AdminMaster\MasterController::updateProducts');