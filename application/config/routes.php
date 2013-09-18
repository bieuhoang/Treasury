<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site/index";
$route['404_override'] = 'site/page_404';

// front page
$route['about-us'] = 'site/about_us';
$route['terms-and-conditions'] = 'site/terms_and_conditions';
$route['contact-us'] = 'site/contact_us';
$route['search'] = 'site/search';
$route['(:num)'] = 'site/index/$1';
$route['detail-(:num)-(:any)'] = 'site/page_home/$1/$2';


// users page
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
$route['profile'] = 'user/my_profile';
$route['register'] = 'user/register';
$route['register-shop'] = 'user/register_shop';
$route['register-for-shop-owner'] = 'user/register_shop';
$route['forgot-password'] = 'user/forgot_password';
$route['change-password'] = 'user/change_password';
$route['store-promotions'] = 'user/my_store';
$route['store-dashboard'] = 'user/my_store';
$route['store-promotions/(:num)'] = 'user/my_store/$1';
$route['store-dashboard/(:num)'] = 'user/my_store/$1';
$route['my-treasury'] = 'user/my_treasury';
$route['my-treasury/(:num)'] = 'user/my_treasury/$1';
$route['user/add-new-promotion'] = 'user/add_new_promotion';
$route['user/qr-code'] = 'user/qr_code';
$route['my-dashboard'] = 'user/my_dashboard';
$route['my-shop'] = 'user/my_shop';
$route['my-shop/(:num)'] = 'user/my_shop/$1';
$route['my-dashboard/(:num)'] = 'user/my_shop/$1';
$route['shop/(:num)'] = 'user/view_shop/$1';
$route['store/(:num)-(:any)'] = 'user/view_shop/$1';
$route['my-promotion'] = 'user/my_promotion';
$route['my-promotion/(:num)'] = 'user/my_promotion/$1';

// promotion
$route['promotion/(:num)'] = 'user/view_promotion/$1';
$route['promotion/(:num)/(:any)'] = 'user/view_promotion/$1';
$route['promotion/(:num)-(:any)'] = 'user/view_promotion/$1';

// administrator
$route['admin/(:any)'] = 'admincp/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */