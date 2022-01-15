<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class loginModel extends CI_Model {
 
    var $table = 'tbl_user';
 
    public function __construct()
    {
        parent::__construct();
       //$this->load->database();
    }
}