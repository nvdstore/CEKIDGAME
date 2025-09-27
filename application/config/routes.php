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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/v1/check-game']['post'] = 'api/cekGame';

$route['auth']['post'] = 'auth/authCek';
$route['logout']['get'] = 'auth/logout';
$route['dashboard']['get'] = 'web/dashboard';
$route['profile']['get'] = 'web/profile';
$route['profile']['post'] = 'web/saveProfile';
$route['profile/update/api']['post'] = 'web/updateApi';
$route['list/game']['get'] = 'web/listGame';
$route['api/documentation']['get'] = 'web/apiDoc';



$route['data/user']['get'] = 'admin/dataUser';
$route['data/user/add']['get'] = 'admin/dataUserAdd';
$route['data/user/add']['post'] = 'admin/saveDataUser';
$route['data/user/delete/(:num)']['get'] = 'admin/deleteDataUser/$1';
$route['data/user/status']['post'] = 'admin/statusDataUser';
$route['data/user/edit/(:num)']['get'] = 'admin/editDataUser/$1';
$route['data/user/edit/(:num)']['post'] = 'admin/saveEditDataUser/$1';
$route['setting/web']['get'] = 'admin/settingWeb';
$route['setting/web']['post'] = 'admin/saveSettingWeb';



