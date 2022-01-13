<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class customerModel extends CI_Model {
 
    var $table = 'tbl_customers';
 
    public function __construct()
    {
        parent::__construct();
    }

    public function addCustomer($data)
    {
     return $this->db->insert($this->table, $data);
    }

    public function customerMobileExsits($mobile)
    {
        $this->db->where('c_phone',$mobile);
        $query=$this->db->get($this->table);
        return $query->num_rows();
    }

    public function customerList()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('c_id', 'DESC');
        $query = $this->db->get();
        return $query->result(); 
    }

    public function customerDetail($id)
    {
       $this->db->select('*');
       $this->db->from($this->table);
       $this->db->where('c_id', $id);
       $query = $this->db->get();
       return $query->row();
    }

    public function updateCustomerInfo($data,$id)
    {
        return $this->db->update($this->table, $data, array('c_id' => $id));
    }

    public function customerDelete($id)
    {
       $this->db->where('c_id', $id);
       return $this->db->delete($this->table);
    }
}