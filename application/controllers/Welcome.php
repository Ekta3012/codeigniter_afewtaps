<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		    
		
                $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('index');
                }
                else
                {
                        $this->load->view('formsuccess');
                }
		
	}
	public function userapp()
	{

                        $this->load->view('userapp');
                
		
	}
	
		public function servapp()
	{

                        $this->load->view('servapp');
                
		
	}
		public function management()
	{

                        $this->load->view('management');
                
		
	}
	
		public function career()
	{

                        $this->load->view('career');
                
		
	}
	    
		public function terms()
	{

                        $this->load->view('terms');
                
		
	}
	
	public function privacypolicy()
	{

                        $this->load->view('privacypolicy');
                
		
	}
	
	public function faq()
	{

                        $this->load->view('faq');
                
		
	}
	
	
	
}
