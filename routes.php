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

$route['signup']                 = 'welcome/submit';
$route['captcha']                = 'welcome/captcha';
$route['activate/(:any)']        = 'welcome/activate/$1';



$route['default_controller']      =  'welcome';

$route['404_override']            =  '';

$route['translate_uri_dashes']    =  FALSE;



$route['user/createaccount']      =  'User/auth/createAccount';
$route['user/createaccount_new']      =  'User/auth/createAccount_new';
$route['user/update_device_token']      =  'User/auth/update_device_token';
$route['sendOTP_n']               =  'User/auth/sendOTP_n';
$route['matchOTP_n']               =  'User/auth/matchOTP_n';

$route['user/fbaccount']          =  'User/auth/fbAccount';



$route['user/verifyotp']       	  =  'User/auth/verifyOtp';

$route['user/mobileno']        	  =  'User/auth/sendMobileNumber';

$route['user/signin']          	  =  'User/auth/signIn';

$route['recoverpassword']         =  'User/auth/forgotPwd';

$route['updatepassword']          =  'User/auth/updatePasswordHere';

$route['near-by-establishment']   =  'Establishment/estab/index';


$route['search-establishment']    =  'Establishment/estab/searchEstablishment';


$route['order-placed']             =  'User/web/orderPlace';


$route['resend-otp']               =  'User/auth/resendOtp';


$route['ask-nudge']                =  'User/menu/dontAskNudge';


$route['offer']                    =  'Establishment/estab/offer';





//$route['branch-location-payments/(:num)']   =  'User/web/getPaymentAndLocations/$1';

//$route['apply-coupon']                      =  'User/web/applyCouponCode';

//$route['menu-items']   		               =  'User/menu/menuItems';






$route['food-items']   		               =  'User/menu/foodItems';

$route['drinks-items']   	               =  'User/menu/drinkItems';

$route['estab-location']   		           =  'User/web/estabLocation';

$route['test']       					   =  'User/menu/d';

$route['myorders']       			       =  'User/menu/myOrders';

$route['filter']       			           =  'User/menu/filterEstablishment';


$route['order-history']       			   =  'User/menu/orderHistory';


$route['order-review-comments']            =  'User/menu/orderReviewComment';

$route['regular-order-customization']      =  'User/menu/regularOrderCustomization';


$route['coupon-estab-detail']              =  'User/menu/couponEstab';


$route['order-serving-detail']       	   =  'User/menu/orderServingDetail';


$route['estab-user-rating-answer']         =  'User/menu/userRatingAnswer';

$route['estab-location-payment']           =  'User/web/estabLocation';

$route['estab-take-order']                 =  'User/menu/takeOrder';

$route['estab-nudge-order']                =  'User/menu/nudgeOrder';

$route['estab-cancel-order']               =  'User/menu/userOrderCancel';

$route['save-locality']                    =  'User/menu/locality';

$route['view-locality']                    =  'User/menu/viewLocality';

$route['estab-menu-items']                 =  'User/menu/estabMenuItems';


$route['user-profile']                     =  'User/auth/viewProfile';


$route['user-edit-profile']                =  'User/auth/editProfile';

$route['faq']                              =  'User/auth/faq';

$route['user-terms-cms']                   =  'User/auth/userTermsCms';

$route['user-policy-cms']                  =  'User/auth/userPolicyCms';

$route['estab-user-rating']                =  'User/menu/userRating';

$route['estab-rating-reply']               =  'User/menu/estabReply';

$route['estab-tax']                        =  'User/menu/getTax';

$route['menuitems']       	               =  'User/menu/getEstabMenuItems';


$route['estab-tax1']                       =  'User/menu/getTax1';


$route['last-order-notify']                =  'User/menu/lastOrderNotify';

$route['payment']                          =  'User/menu/payment';


$route['payredirect']                      =  'User/menu/payredirect';
$route['paywebhook']                       =  'User/menu/paywebhook';


$route['repeat-order']                     =  'User/menu/repeatOrder';


$route['paymentsuccess']                   =  'Establishment/payment/paymentSuccess';

$route['badge']                            =  'Establishment/estab/badge';

$route['badgecount']                       =  'Establishment/estab/badgeCount';

$route['badgeread']                        =  'Establishment/estab/badgeRead';


$route['feedback']                         =  'Establishment/estab/feedback';


$route['orderstatus']                      =  'Establishment/estab/orderStatus';


$route['select-cod-payment']               =  'User/menu/codPaymentMethod';


$route['service/menuitemcomplete']         =  'Service/service/menuItemComplete';

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
$route['service/orderhistory']             =  'Service/service/orderHistory';

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

$route['service/forgotpassword']       	   =  'Service/service/forgotPassword';

$route['service/forgotverifyotp']          =  'Service/service/forgotVerifyOtp';

$route['service/updatePassword']       	   =  'Service/service/updatePasswordHere';

$route['service/changepicture']       	   =  'Service/service/changeProfilePic';


//Edit By Web Shuttle - 27th Jan 2017 onwards//
$route['service/getAllMenu']               =  'Service/service/getAllMenu';
$route['service/getOrderId']               =  'Service/service/getOrderId';
$route['orderMethod']                      =  'User/menu/orderMethod';
$route['service/viewLocation']             =  'Service/service/viewLocation';
$route['service/getThresoldLimit']         =  'Service/service/getThresoldLimit';
$route['service/updateOrderStatus']         =  'Service/service/updateOrderStatus';

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