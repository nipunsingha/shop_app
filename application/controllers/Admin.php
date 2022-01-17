<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	
    public function __construct() {
      parent::__construct();
      if (! $this->session->userdata('username'))
      {
          redirect('Login/index'); // the user is not logged in, redirect them!
      }
    }

	public function index()
	{
		$data['headertitle'] = 'Home | SMWA';
		$this->load->view('admin/headers/header/header.php',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/home/home.php');
		$this->load->view('footer');
	}
}
