<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/home');
		$this->load->view('footer');
	}
}
