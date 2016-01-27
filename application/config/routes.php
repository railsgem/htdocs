<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['kpi/list'] = 'kpi/list';
$route['kpi/create'] = 'kpi/create';
$route['kpi/edit'] = 'kpi/edit';
$route['kpi/(:any)'] = 'kpi/index';
$route['kpi'] = 'kpi';

$route['product/create'] = 'product/create';
$route['product/edit'] = 'product/edit';
$route['product/import_purchase'] = 'product/import_purchase';
$route['product/import_product'] = 'product/import_product';
$route['product/import_record'] = 'product/import_record';
$route['product/download_kounta_file'] = 'product/download_kounta_file';
$route['product/download_products'] = 'product/download_products';
$route['product/report'] = 'product/report';
$route['product/history'] = 'product/history';
$route['product/(:any)'] = 'product/index';
$route['product'] = 'product';

$route['stock/index'] = 'stock/index';
$route['stock/get_product_json'] = 'stock/get_product_json';
$route['stock/create'] = 'stock/create';
$route['stock/edit'] = 'fetch/edit';
$route['stock/delete'] = 'stock/delete';
$route['stock/(:any)'] = 'stock/index';
$route['stock'] = 'stock';

$route['fetch/index'] = 'fetch/index';
$route['fetch/fetch'] = 'fetch/fetch';
$route['fetch/save_fetch'] = 'fetch/save_fetch';
$route['fetch/edit'] = 'fetch/edit';
$route['fetch/(:any)'] = 'fetch/index';
$route['fetch'] = 'fetch';

$route['category/index'] = 'category/index';
$route['category/create'] = 'category/create';
$route['category/edit'] = 'category/edit';
$route['category/(:any)'] = 'category/index';
$route['category'] = 'category';

$route['brand/index'] = 'brand/index';
$route['brand/create'] = 'brand/create';
$route['brand/edit'] = 'brand/edit';
$route['brand/(:any)'] = 'brand/index';
$route['brand'] = 'brand';

$route['auth/reset_password'] = 'auth/reset_password';
$route['auth/forgot_password'] = 'auth/forgot_password';
$route['auth/edit_user'] = 'auth/edit_user';
$route['auth/edit_group'] = 'auth/edit_group';
$route['auth/deactivate_user'] = 'auth/deactivate_user';
$route['auth/create_user'] = 'auth/create_user';
$route['auth/create_group'] = 'auth/create_group';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';
$route['auth/change_password'] = 'auth/change_password';
$route['auth/(:any)'] = 'auth/index';
$route['auth'] = 'auth';

$route['(:any)'] = 'brand';
$route['default_controller'] = 'brand';

//$route['default_controller'] = 'home/index';
//$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
