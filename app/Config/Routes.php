<?php

use CodeIgniter\Router\RouteCollection;

// $routes->setAutoRoute(true);

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/services', 'Home::services');
$routes->get('/achievement', 'Home::achievement');
$routes->get('/detail_achievement/(:any)', 'Home::detailAchievement/$1');
$routes->get('/update', 'Home::article');
$routes->get('/detail_update/(:any)', 'Home::detailArticle/$1');
$routes->get('/contact', 'Home::contact');
$routes->add('/contact', 'Home::messages');

$routes->add('/admins/logout', 'Admin::logout');

$routes->group('admins', ['filter' => 'noauth'], function ($routes) {
    $routes->add('', 'Admin::login');
    $routes->add('login', 'Admin::login');
    $routes->add('lupapassword', 'Admin::lupapassword');
    $routes->add('resetpassword', 'Admin::resetpassword');
});

$routes->group('admins', ['filter' => 'auth'], function ($routes) {
    $routes->add('sukses', 'Admin::sukses');

    $routes->add('update', 'Article::index');
    $routes->add('update/tambah', 'Article::tambah');
    $routes->add('update/edit/(:any)', 'Article::edit/$1');

    $routes->add('page', 'Page::index');
    $routes->add('page/tambah', 'Page::tambah');
    $routes->add('page/edit/(:any)', 'Page::edit/$1');

    $routes->add('jumbotron', 'Jumbotron::index');
    $routes->add('jumbotron/tambah', 'Jumbotron::tambah');
    $routes->add('jumbotron/edit/(:any)', 'Jumbotron::edit/$1');

    $routes->add('about', 'About::index');
    $routes->add('about/tambah', 'About::tambah');
    $routes->add('about/edit/(:any)', 'About::edit/$1');

    $routes->add('management_team', 'Management_team::index');
    $routes->add('management_team/tambah', 'Management_team::tambah');
    $routes->add('management_team/edit/(:any)', 'Management_team::edit/$1');

    $routes->add('services', 'Services::index');
    $routes->add('services/tambah', 'Services::tambah');
    $routes->add('services/edit/(:any)', 'Services::edit/$1');

    $routes->add('achievement', 'Achievement::index');
    $routes->add('achievement/tambah', 'Achievement::tambah');
    $routes->add('achievement/edit/(:any)', 'Achievement::edit/$1');

    $routes->add('brand', 'Brand::index');
    $routes->add('brand/tambah', 'Brand::tambah');
    $routes->add('brand/edit/(:any)', 'Brand::edit/$1');

    $routes->add('contact', 'Contact::index');
    $routes->add('contact/tambah', 'Contact::tambah');
    $routes->add('contact/edit/(:any)', 'Contact::edit/$1');

    $routes->add('socials', 'Socials::index');

    $routes->add('akun', 'Akun::index');
});
