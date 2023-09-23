<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/music_view', 'MusicController::shekinah');
$routes->post('/insertAudio', 'MusicController::insertAudio'); 
$routes->get('/music_view/(:any)', 'MusicController::music_view/$1');
$routes->post('/save', 'MusicController::save');
$routes->get('/delete/(:any)', 'MusicController::delete/$1');