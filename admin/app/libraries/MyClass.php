<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyClass {
    public function myfunction() {
        $CI =& get_instance();
        $CI->load->helper('site_helper');
        $CI->load->library('session');
        // do something else below
    }
}
?>