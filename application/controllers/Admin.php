<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$data['headertitle'] = 'Home | SMWA';
		$this->load->view('admin/headers/header/header.php',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/home/home.php');
		$this->load->view('footer');
	}
}
