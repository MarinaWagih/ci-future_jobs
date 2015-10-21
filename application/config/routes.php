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
|	http://codeigniter.com/user_guide/general/routing.html
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
//$route['default_controller'] = 'welcome';
$route['default_controller'] = "JobController/recent";
$route['test'] = 'test';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//user Routes
$route['user']='UserController';
$route['user/add']='UserController/add';
$route['user/store']='UserController/store';
$route['user/edit']='UserController/edit';
$route['user/update']='UserController/update';
$route['user/show']='UserController/show';
$route['user/delete']='UserController/delete';
$route['username/unique']='UserController/is_userName_Valid';
$route['email/unique']='UserController/is_email_Valid';
//country Routes
$route['country']='CountryController';
$route['country/add']='CountryController/add';
$route['country/store']='CountryController/store';
$route['country/edit']='CountryController/edit';
$route['country/update']='CountryController/update';
$route['country/show']='CountryController/show';
$route['country/delete']='CountryController/delete';
$route['country_name/unique']='CountryController/is_name_Valid';
//category Routes
$route['category']='CategoryController';
$route['category/add']='CategoryController/add';
$route['category/store']='CategoryController/store';
$route['category/edit']='CategoryController/edit';
$route['category/update']='CategoryController/update';
$route['category/show']='CategoryController/show';
$route['category/delete']='CategoryController/delete';
$route['category_name/unique']='CategoryController/is_name_Valid';
//job Routes
$route['job']='JobController';
$route['job/add']='JobController/add';
$route['job/store']='JobController/store';
$route['job/edit']='JobController/edit';
$route['job/update']='JobController/update';
$route['job/show']='JobController/show';
$route['job/delete']='JobController/delete';
$route['job/apply']='JobController/apply';
$route['job/recent']='JobController/recent';
$route['job/country']='JobController/by_country';
$route['job/search']='JobController/search';
//about Routes

$route['professional_consulting_services']='AboutController/professional_consulting_services';
$route['professional_consulting_services/edit']='AboutController/edit_professional_consulting_services';
$route['professional_consulting_services/update']='AboutController/update_professional_consulting_services';
$route['about']='AboutController';
$route['about/edit']='AboutController/edit';
$route['about/update']='AboutController/update';
//contact_us Routes
$route['contact_us']='ContactUsController';
$route['contact_us/add']='ContactUsController/add';
$route['adv_with_us']='ContactUsController/index_adv';
$route['adv_with_us/add']='ContactUsController/add_adv';
$route['companies_contract']='ContactUsController/index_companies';
$route['companies_contract/add']='ContactUsController/add_companies';
//login Routes
$route['login']='LoginController';
$route['logout']='LoginController/logout';
$route['login/verify']='LoginController/verify';
//foreign_labor Routes
$route['foreign_labor']='Foreign_laborController';
$route['foreign_labor/add']='Foreign_laborController/add';
$route['foreign_labor/store']='Foreign_laborController/store';
$route['foreign_labor/edit']='Foreign_laborController/edit';
$route['foreign_labor/update']='Foreign_laborController/update';
$route['foreign_labor/show']='Foreign_laborController/show';
$route['foreign_labor/delete']='Foreign_laborController/delete';
//advertisement Routes
$route['advertisement']='AdvertisementController';
$route['advertisement/add']='AdvertisementController/add';
$route['advertisement/store']='AdvertisementController/store';
$route['advertisement/edit']='AdvertisementController/edit';
$route['advertisement/update']='AdvertisementController/update';
$route['advertisement/show']='AdvertisementController/show';
$route['advertisement/delete']='AdvertisementController/delete';
//Change_lang
$route['change_lang']='Change_langController/index';

