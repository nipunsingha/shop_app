<?php
/**
 * 
 */
class Login extends CI_Controller
{
	
   public function __construct() 
   {
      parent::__construct();
      $this->load->library('breadcrumb');
      $this->load->model('loginModel');
   }

   public function index(){
   	 $this->load->view("login/login");
   }

   public function login_validation() { 

	   $this->load->library('form_validation');  
	   $this->form_validation->set_rules('username', 'Username', 'required');  
	   $this->form_validation->set_rules('password', 'Password', 'required');  
	   if($this->form_validation->run())  
	   {  
	        //true  
	        $username = $this->input->post('username');  
	        $password = $this->input->post('password');  
	        //model function  
	        $this->load->model('loginModel');  
	        if($this->loginModel->login($username, $password))  
	        {  
	             $session_data = array(  
	                  'username'     => $username  
	             );  
	             $this->session->set_userdata($session_data);  
	             redirect(base_url() . 'Admin');  
	        }  
	        else  
	        {  
	             $this->session->set_flashdata('error', 'Invalid Username and Password');  
	             redirect(base_url('Login/index'));  
	        }  
	   }  
	   else  
	   {  
	        //false  
	        $this->index();  
	   }  
	}

}   