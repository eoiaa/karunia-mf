<?php

use CodeIgniter\Router\RouteCollection;

// $routes->setAutoRoute(true);

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/blog', 'Home::article');
// $routes->get('/admins/lupapassword', 'Admin::lupapassword');

$routes->add('/admins/logout', 'Admin::logout');

$routes->group('admins', ['filter' => 'noauth'], function ($routes) {
    $routes->add('', 'Admin::login');
    $routes->add('login', 'Admin::login');
    $routes->add('lupapassword', 'Admin::lupapassword');
    $routes->add('resetpassword', 'Admin::resetpassword');
});

$routes->group('admins', ['filter' => 'auth'], function ($routes) {
    $routes->add('sukses', 'Admin::sukses');
    $routes->add('article', 'Article::index');
    $routes->add('article/tambah', 'Article::tambah');
    $routes->add('article/edit/(:any)', 'Article::edit/$1');

    $routes->add('page', 'Page::index');
    $routes->add('page/tambah', 'Page::tambah');
    $routes->add('page/edit/(:any)', 'Page::edit/$1');

    $routes->add('socials', 'Socials::index');

    $routes->add('akun', 'Akun::index');
});
