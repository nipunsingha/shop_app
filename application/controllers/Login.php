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
      $this->load->library('session');
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
   }

   public function index(){
   	 $this->load->view("login/login");
   }


function login_user(){ 

 $this->form_validation->set_rules('username', 'Username', 'required');
 $this->form_validation->set_rules('password', 'Password', 'required');


 if ($this->form_validation->run() == FALSE) {
 $this->load->view("login/login");
 } else {

    $username= trim($this->input->post('username'));
    $password= trim($this->input->post('password'));
 
    $data=$this->loginModel->login_user($username);
 
 if(!$data) {
 $this->session->set_flashdata('login_error', '<div class="alert alert-warning"> Please check your email or password.
</div>', 300);

 redirect(uri_string());
 }
 
       if($data)
      {
        foreach ($data as $key => $value) {
          $pass = $value->password;
          $username = $value->username;
          $name = $value->name;
          $level = $value->level;
        }
  
         if(!password_verify($password,$pass)) {
         $this->session->set_flashdata('login_error', '<div class="alert alert-warning"> Please check your email or password.</div>', 300);
         redirect(uri_string());
         }



    // if(password_verify($password,$pass)){

        $this->session->set_userdata('username', $value->username);
        $this->session->set_userdata('name', $value->name);
        $this->session->set_userdata('level', $value->level);
        redirect(base_url('Admin/index'));
    // }

     }
     else{
       $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
       redirect(base_url('Login'));

     }

 }


}

	public function logout(){
		//load session library
		$this->load->library('session');
		$this->session->unset_userdata('username');
		redirect('Login');
	}

}   