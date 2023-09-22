<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/music_view', 'MusicController::shekinah');
$routes->get('/music_view/(:any)', 'MusicController::music_view/$1');
