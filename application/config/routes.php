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

$route['default_controller'] = "welcome";
$route['404_override'] = '';

// Redmine compatibility routes

// Account-related routes belong in account class
$route['login']            = 'account/login';
$route['logout']           = 'account/logout';
$route['my/account']       = 'account/overview';
$route['my/password']      = 'account/change_password';
$route['my/reset_rss_key'] = 'account/reset_rss_key';

// Same for admin related routes
$route['users']             = 'admin/users';
$route['groups']            = 'admin/groups';
$route['roles']             = 'admin/roles';
$route['trackers']          = 'admin/trackers';
$route['issue_statuses']    = 'admin/issue_statuses';
$route['workflows']         = 'admin/workflows';
$route['custom_fields']     = 'admin/custom_fields';
$route['enumarations']      = 'admin/enumarations';
$route['settings']          = 'admin/settings';
$route['ldap_auth_sources'] = 'admin/ldap_auth_sources';

/* End of file routes.php */
/* Location: ./application/config/routes.php */