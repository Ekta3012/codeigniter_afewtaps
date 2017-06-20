

<?php
class main_controller extends CI_Controller {
function __construct() {
parent::__construct();
//$this->load->model('form_model');
}
function index() {
$this->load->view('form');
}
}
?>

