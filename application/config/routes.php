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
$route['default_controller'] = 'Home';
$route['essentials/(:any)'] = 'home/viewCategoryByname/$1';
$route['products/(:any)'] = 'home/getAllOffer/$1';
$route['create-an-account'] = 'auth/register';
$route['account-login'] = 'auth/login';

// services controller
$route['about_us'] = 'services/about_us';
$route['returns_policy'] = 'services/returnPolicy';
$route['store-location'] = 'services/storeLocation';
$route['privacy-cookies_policy'] = 'services/cookie_policy';
$route['help-center'] = 'services/help_center';
$route['faq'] = 'services/faq';
$route['terms_conditions'] = 'services/terms';

$route['checkouts'] = 'Checkout/checkOut';
$route['checkout'] = 'Checkout/CheckoutPage';
$route['checkout/buynowpaylater/lipalater-checkout'] = 'lipalater/account';

$route['customer/account/index'] = 'auth/accounts';
$route['customer/account/orders'] = 'auth/customerOrders';
$route['customer/account/orderdatails/(:any)'] = 'auth/getCustomerOrders/$1';
$route['customer/account/changepass']  = 'auth/changeUserPassword';

$route['(:any)'] = 'home/getProductdetails/$1';
$route['brand/(:any)/(:any)'] = 'home/viewBrands/$1/$2';
$route['shop/products/search'] = 'home/search';
$route['shop/(:any)/(:any)'] = 'home/view/$1/$2';
$route['store/(:any)/(:any)'] = 'home/viewCategory/$1/$2';
$route['shopping/cart'] = 'home/viewCart';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
