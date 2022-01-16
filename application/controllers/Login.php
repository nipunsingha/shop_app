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
   }

   public function index(){
   	 $this->load->view("login/login");
   }


function login_user(){ 
	  // $user_login=array(
	  // 'username'=>$this->input->post('username'),
	  // 'password'=>md5($this->input->post('password'))
	  //  ); 

	  $username=$this->input->post('username');
	  $password= $this->input->post('password');

	  $hash = password_hash($password, PASSWORD_DEFAULT);
	    
	   $data=$this->loginModel->login_user($username, $hash);

      if($data)
      {
		  
        $this->session->set_userdata('user_id',$data[0]['user_id']);
        $this->session->set_userdata('name',$data[0]['name']);
        $this->session->set_userdata('username',$data[0]['username']);

		echo $this->session->set_userdata('user_id'); 
        
       redirect(base_url('Admin/index'));

     }
     else{
       $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
       $this->load->view("login/login");

     }


}

}   