<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class loginModel extends CI_Model {
 
    var $table = 'tbl_user';
 
    public function __construct()
    {
        parent::__construct();
       //$this->load->database();
    }

    public function login_user($username, $hash){
		  $this->db->from('tbl_user');
		  $this->db->where('username',$username);
		  $this->db->where('password',$hash);
		  $query = $this->db->get();

		  return $query->result();
    }
}