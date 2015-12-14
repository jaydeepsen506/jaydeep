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
$route['default_controller'] = 'home/index';
$route['about-us'] = 'aboutus/index';
$route['404_override'] = 'notFound';
$route['tools'] = 'toolbox/index';
$route['my-account'] = 'dashboard/my_account_page';
$route['compose-message'] = 'dashboard/compose_new_message';
$route['network'] = 'dashboard/network_page';
$route['client-profile/(:num)'] = 'dashboard/client_profile/$1';
$route['delete-client/(:num)'] = 'dashboard/delete_client_account/$1';
$route['change-client-pass/(:num)'] = 'dashboard/client_password_change/$1';
$route['logout'] = 'login/logout';
$route['home/:any'] = 'home';



/*admin*/
$route['control'] = 'user/index';
$route['control/signup'] = 'user/signup';
$route['control/create_member'] = 'user/create_member';
$route['control/login'] = 'user/index';
$route['control/logout'] = 'user/logout';
$route['control/login/validate_credentials'] = 'user/validate_credentials';

$route['control/dashboard'] = 'admin_dashboard/index';

$route['control/chngpassword'] = 'admin_chngpassword/index';
$route['control/chngpassword/updt'] = 'admin_chngpassword/updt';

$route['admin/usersetting'] = 'admin_usersetting/index';
$route['admin/usersetting/updt'] = 'admin_usersetting/updt';

$route['control/sitesetting'] = 'admin_sitesetting/index';
$route['control/sitesetting/updt'] = 'admin_sitesetting/updt';

$route['control/homepage'] = 'admin_homepage/index';
$route['control/homepage/updt'] = 'admin_homepage/updt';

$route['control/contactsetting'] = 'admin_contactsetting/index';
$route['control/contactsetting/updt'] = 'admin_contactsetting/updt';

$route['control/myaccount'] = 'admin_myaccount/index';
$route['control/myaccount/updt'] = 'admin_myaccount/updt';


//meal management
$route['control/meal_management'] = 'meal/index';
$route['control/meal_options/(:any)'] = 'meal/meal_options/$1';
$route['control/img_options/(:any)'] = 'meal/img_options/$1';
//$route['control/ptplanner/delete/(:any)']='ptplanner/delete/$1';

///exercise
$route['control/exercise'] = 'exercise/index';
$route['control/exercise_options/(:any)'] = 'exercise/exercise_options/$1';
$route['control/video_options/(:any)'] = 'exercise/video_options/$1';

///User Booking
$route['control/booking'] = 'booking/index';

///Program list
$route['control/program'] = 'program/index';
$route['control/program_default_list/(:any)'] = 'program/program_details/$1';


// for User
$route['control/user'] = 'admin_user/index';
$route['control/user/add'] = 'admin_user/add';
$route['control/user/edit/:num'] = 'admin_user/edit/$1';
$route['control/user/update/:num'] = 'admin_user/update/$1';
$route['control/user/delete/:num'] = 'admin_user/delete';

/// For Network Management
$route['control/network'] = 'admin_network/index';
//$route['control/network/(:num)'] = 'admin_network/index/$1'; //$1 = page number

$route['control/pages'] = 'admin_pages/index';
$route['control/pages/(:num)'] = 'admin_pages/index/$1'; //$1 = page number
$route['control/pages/add'] = 'admin_pages/add';
$route['control/pages/update/(:num)'] = 'admin_pages/update/$1';
$route['control/pages/delete/(:num)'] = 'admin_pages/delete/$1';
$route['control/pages/updatelang/(:num)/(:num)'] = 'admin_pages/updatelang/$1/$2';

////Home Page Management////






$route['control/slider'] = 'admin_slider/index';
$route['control/slider/(:num)'] = 'admin_slider/index/$1'; //$1 = page number
$route['control/slider/add'] = 'admin_slider/add';
$route['control/slider/update/(:num)'] = 'admin_slider/update/$1';
$route['control/slider/delete/(:num)'] = 'admin_slider/delete/$1';

$route['control/subject'] = 'admin_subject/index';
$route['control/subject/(:num)'] = 'admin_subject/index/$1'; //$1 = page number
$route['control/subject/add'] = 'admin_subject/add';
$route['control/subject/update/(:num)'] = 'admin_subject/update/$1';
$route['control/subject/delete/(:num)'] = 'admin_subject/delete/$1';

$route['control/course'] = 'admin_course/index';
$route['control/course/(:num)'] = 'admin_course/index/$1'; //$1 = page number
$route['control/course/add'] = 'admin_course/add';
$route['control/course/update/(:num)'] = 'admin_course/update/$1';
$route['control/course/delete/(:num)'] = 'admin_course/delete/$1';

//for manage contact
$route['control/managecontact'] = 'contact_manage_admin/index';
$route['control/managecontact/edit/(:num)'] = 'contact_manage_admin/edit/$1';

//for store management
$route['control/store'] = 'prod_control/storesetting';
$route['control/pages/add']='prod_control/instore';
$route['control/store/viewprod/(:num)']='prod_control/viewprod/$1';
$route['control/store/map/(:num)'] = 'prod_control/map/$1';
$route['control/pages/addstore']='prod_control/insdata';
$route['control/store/checkbox']='prod_control/multistoredel';
$route['control/storeset/update/(:num)']='prod_control/updateshow/$1';
$route['control/pages/addstore/(:num)']='prod_control/update/$1';
$route['control/storeset/delete/(:num)']='prod_control/delete/$1';
//for product management
$route['control/product']='prod_control/productdis';
$route['control/addition/addpro']='prod_control/addpro';
$route['control/manageproduct/insert']='prod_control/insprod';
$route['control/edit/product/(:num)']='prod_control/proeditshow/$1';
$route['control/manageproduct/update/(:num)']='prod_control/produpdate/$1';
$route['control/product/delete/(:num)']='prod_control/prodel/$1';
$route['control/addition/gallery']='prod_control/gallery';
$rutes['control//colorbox/imgdel']='prod_control/imgdel';


//for manage trainer
$route['control/managetrainer'] = 'usermanage_admin/index';
$route['control/managetrainer/edit/(:any)'] = 'usermanage_admin/edit/$1';
$route['control/managetrainer/upgradetrainer/(:num)'] = 'usermanage_admin/upgrade/$1';


///for Manage client
$route['control/manageclient'] = 'usermanage_client/index';

// for testimonials
$route['control/managetestimonials'] = 'testimonials_manage/index';
$route['control/managetestimonials/add'] = 'testimonials_manage/add';
$route['control/managetestimonials/insert'] = 'testimonials_manage/insert';
$route['control/managetestimonials/edit/(:num)'] = 'testimonials_manage/edit/$1';
$route['control/managetestimonials/update/(:num)'] = 'testimonials_manage/update/$1';
$route['control/managetestimonials/delete/(:num)'] = 'testimonials_manage/delete/$1';


/*Email Template Management*/
$route['control/email_template_management'] = 'admin_email_template/index';
$route['control/email_template_management/add'] = 'admin_email_template/add';
$route['control/email_template_management/update/(:any)'] = 'admin_email_template/update/$1';
$route['control/email_template_management/(:any)'] = 'admin_email_template/index/$1';
/*Email Template Management*/

/*------------------ site ------------------*/



/* End of file routes.php */
/* Location: ./application/config/routes.php */
