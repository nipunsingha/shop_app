<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class soldModel extends CI_Model {
 
    var $table = 'tbl_sell';
 
    public function __construct()
    {
        parent::__construct();
       //$this->load->database();
    }
}