<?php
defined('BASEPATH')  OR  exit('No direct script access allowed');

$config['admin_logo_title']   =	      'A few taps';
$config['site_title']         = 	  'A few taps - ';
$config['from_email']         = 	  'no-reply@xlim.org';
$config['from_name']          = 	  'A Few Taps';
$config['admin_email']        = 	  'appsdev4@xlim.org';
$config['admin_email_error']  = 	  'tech1@xlim.org';


$config['msg91url']           =       "https://control.msg91.com/sendhttp.php";
/**
    * Pageid
*/
const ABOUT_US_ID        	  =   1;
const TERMS_CONDITIONS   	  =   2;
const PRIVACY_POLICY     	  =   3;


/**
 *   MSG91 configuration
*/

const MSG91_AUTH_KEY    	=   "102280ANXen0crHhQ5694c8a0";
const MSG91_SENDER_ID   	=   "XLIMIT"; // sender id should 6 character long //


/*
|--------------------------------------------------------------------------
| Google API Key
|--------------------------------------------------------------------------
|
*/

define("ANDROID_GCM_SEND_URL", "https://android.googleapis.com/gcm/send");

define("GOOGLE_API_KEY", "AIzaSyDc_DZ6W_aX3ugET3YC7NCmJ1EqYi1U_oU");
