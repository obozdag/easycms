<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->setAutoRoute(true);
$routes->get('/', 'Website\Home::index');
$routes->get('/website/content/(:num)', 'Website\Content::index/$1');
$routes->get('/website/search/(:any)', 'Website\Search::index/$1');
$routes->get('/website/subcategory/(:num)', 'Website\Subcategory::index/$1');
$routes->post('/website/home/ajaxContact', 'Website\Home::ajaxContact');

$routes->get('/webadmin', 'Webadmin\Home::getIndex');
$routes->get('/webadmin/visit', 'Webadmin\Visit::index');

$routes->match(['get', 'post'], '/webadmin/category/checkBox', 'Webadmin\Category::checkBox');
$routes->match(['get', 'post'], '/webadmin/setting/checkBox', 'Webadmin\Setting::checkBox');
$routes->match(['get', 'post'], '/webadmin/content/checkBox', 'Webadmin\Content::checkBox');
$routes->match(['get', 'post'], '/webadmin/language/checkBox', 'Webadmin\Language::checkBox');
$routes->match(['get', 'post'], '/webadmin/page/checkBox', 'Webadmin\page::checkBox');
$routes->match(['get', 'post'], '/webadmin/place/checkBox', 'Webadmin\place::checkBox');
$routes->match(['get', 'post'], '/webadmin/subcategory/checkBox', 'Webadmin\Subcategory::checkBox');

$routes->match(['get', 'post'], '/webadmin/category', 'Webadmin\Category::index');
$routes->match(['get', 'post'], '/webadmin/setting', 'Webadmin\Setting::index');
$routes->match(['get', 'post'], '/webadmin/content', 'Webadmin\Content::index');
$routes->match(['get', 'post'], '/webadmin/language', 'Webadmin\Language::index');
$routes->match(['get', 'post'], '/webadmin/page', 'Webadmin\Page::index');
$routes->match(['get', 'post'], '/webadmin/place', 'Webadmin\Place::index');
$routes->match(['get', 'post'], '/webadmin/subcategory', 'Webadmin\Subcategory::index');
$routes->match(['get', 'post'], '/webadmin/user', 'Webadmin\User::index');

$routes->match(['get', 'post'], '/webadmin/category/edit/(:num)', 'Webadmin\Category::edit/$1');
$routes->match(['get', 'post'], '/webadmin/setting/edit/(:num)', 'Webadmin\Setting::edit/$1');
$routes->match(['get', 'post'], '/webadmin/content/edit/(:num)', 'Webadmin\Content::edit/$1');
$routes->match(['get', 'post'], '/webadmin/language/edit/(:num)', 'Webadmin\Language::edit/$1');
$routes->match(['get', 'post'], '/webadmin/page/edit/(:num)', 'Webadmin\Page::edit/$1');
$routes->match(['get', 'post'], '/webadmin/place/edit/(:num)', 'Webadmin\Place::edit/$1');
$routes->match(['get', 'post'], '/webadmin/subcategory/edit/(:num)', 'Webadmin\Subcategory::edit/$1');

$routes->match(['get', 'post'], '/webadmin/category/delete/(:num)', 'Webadmin\Category::delete/$1');
$routes->match(['get', 'post'], '/webadmin/setting/delete/(:num)', 'Webadmin\Setting::delete/$1');
$routes->match(['get', 'post'], '/webadmin/content/delete/(:num)', 'Webadmin\Content::delete/$1');
$routes->match(['get', 'post'], '/webadmin/language/delete/(:num)', 'Webadmin\Language::delete/$1');
$routes->match(['get', 'post'], '/webadmin/page/delete/(:num)', 'Webadmin\Page::delete/$1');
$routes->match(['get', 'post'], '/webadmin/place/delete/(:num)', 'Webadmin\Place::delete/$1');
$routes->match(['get', 'post'], '/webadmin/subcategory/delete/(:num)', 'Webadmin\Subcategory::delete/$1');

$routes->match(['get', 'post'], '/webadmin/category/insert', 'Webadmin\Category::insert');
$routes->match(['get', 'post'], '/webadmin/setting/insert', 'Webadmin\Setting::insert');
$routes->match(['get', 'post'], '/webadmin/content/insert', 'Webadmin\Content::insert');
$routes->match(['get', 'post'], '/webadmin/language/insert', 'Webadmin\Language::insert');
$routes->match(['get', 'post'], '/webadmin/page/insert', 'Webadmin\Page::insert');
$routes->match(['get', 'post'], '/webadmin/place/insert', 'Webadmin\Place::insert');
$routes->match(['get', 'post'], '/webadmin/subcategory/insert', 'Webadmin\Subcategory::insert');

service('auth')->routes($routes);
