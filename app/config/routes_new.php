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
$route['default_controller']      =  'welcome';

$route['404_override']            =  '';

$route['translate_uri_dashes']    =  FALSE;

$route['user/createaccount']      =  'User/auth/createAccount';

$route['user/verifyotp']       	  =  'User/auth/verifyOtp';

$route['user/mobileno']        	  =  'User/auth/sendMobileNumber';

$route['user/signin']          	  =  'User/auth/signIn';

$route['recoverpassword']         =  'User/auth/forgotPwd';

$route['updatepassword']          =  'User/auth/updatePasswordHere';

$route['near-by-establishment']   =  'Establishment/estab/index';

//$route['branch-location-payments/(:num)']   =  'User/web/getPaymentAndLocations/$1';
//$route['apply-coupon']                      =  'User/web/applyCouponCode';

$route['menu-items']   		               =  'User/menu/menuItems';



$route['estab-location']   		               =  'User/web/estabLocation';





$route['service/createaccount']            =  'Service/service/createAccount';

$route['service/cmsContent/(:num)']        =  'Service/service/cmsContent/$1';

$route['service/verifyotp']                =  'Service/service/verifyOtp';

$route['service/resendotp']                =  'Service/service/resendOtp';

$route['service/signin']                   =  'Service/service/signIn';

$route['service/showprofile']              =  'Service/service/showProfile';

$route['service/changestatusonline']       =  'Service/service/changeStatusOnOffLine';

$route['service/serverlogout']             =  'Service/service/serverLogout';

$route['service/orders']                   =  'Service/service/orders';

$route['service/getallorders']             =  'Service/service/getAllOrders';

$route['service/servercancelorder']        =  'Service/service/serverCancelledOrder';

$route['service/serverorderdeliverytime']  =  'Service/service/serverOrderDeliveryTime';

$route['service/servertakeorder']          =  'Service/service/serverTakeOrder';

$route['service/deliverinformation']       =  'Service/service/deliverInformation';

$route['service/reminderorder']            =  'Service/service/reminder';

$route['service/nudgereply']               =  'Service/service/nudgeReply';

$route['service/userprofile']              =  'Service/service/userProfile';


$route['service/deliveryinfohistory']      =  'Service/service/deliveryInformationHistory';

$route['service/orderdelivered']           =  'Service/service/orderDelivered';




$route['service/deliveryinfoorders']       =  'Service/service/deliveryInfoOrders';

$route['service/notificationorders']       =  'Service/service/notificationOrders';



/*

service/orders - new orders


servertakeorder - take new order\


getallorders - pending orders all (nudge, thrueshode etc)


reminderorder - all nudge orders


userprofile - customer profile


showprofile - server profile


service/deliveryinformation - send notification more, minutes


deliveryinfohistory - orders notify with delivery info


serverorderdelivertime - send notifation with time


*/





