<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/saveCreate', 'MusicController::saveCreate');
$routes->post('/save', 'MusicController::save');
$routes->get('/delete/(:any)', 'MusicController::delete/$1');
$routes->get('/music_view', 'MusicController::index');

$routes->post('/insertAudio', 'MusicController::insertAudio'); 

$routes->get('playlist/(:num)', 'MusicController::playlist/$1');

$routes->get('/music_view/(:any)', 'MusicController::music_view/$1'); 
$routes->get('/music_view', 'MusicController::search'); 
$routes->get('/search', 'MusicController::search');

$routes->post('/saveEdit', 'MusicController::saveEdit');

