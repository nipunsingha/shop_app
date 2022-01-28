<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class stokesModel extends CI_Model {
 
  var $table = 'tbl_product';

  var $tbl_subcategory = 'tbl_subcategory';

  var $tbl_category = 'tbl_category';
  // var $column_order = array('cat_name','date',null); //set column field database for datatable orderable
  // var $column_search = array('cat_name','date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('p_id' => 'desc'); // default order 

  public function __construct()
  {
      parent::__construct();
  }
  
  public function stokeslist(){
     $this->db->select('tbl_sold.*, tbl_product.p_name, tbl_product.p_code,tbl_product.p_price,tbl_product.p_qty,tbl_category.cat_name, tbl_subcategory.sub_name');

    $this->db->from('tbl_sold');

    $this->db->join('tbl_product', 'tbl_sold.p_id = tbl_product.p_id','left');

    $this->db->join('tbl_category', 'tbl_product.p_cat=tbl_category.id','left');

    $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id','left');
    //$this->db->join('Soundtrack c', 'c.album_id=a.album_id', 'left');
    $this->db->group_by('tbl_sold.sl_code'); 

    $query = $this->db->get(); 
    return $query->result();
  } 
  

  public function viewStokes($sl_code){
         $this->db->select('tbl_sold.*, tbl_product.p_name, tbl_product.p_code,tbl_product.p_price,tbl_product.p_qty,tbl_category.cat_name, tbl_subcategory.sub_name,tbl_customers.c_name,tbl_customers.c_phone,tbl_customers.c_address');

        $this->db->from('tbl_sold');

        $this->db->join('tbl_product', 'tbl_sold.p_id = tbl_product.p_id','left');

        $this->db->join('tbl_category', 'tbl_product.p_cat=tbl_category.id','left');

        $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id','left');

        $this->db->join('tbl_customers', 'tbl_customers.c_id = tbl_sold.c_id', 'left');

        $this->db->where('tbl_sold.sl_code', $sl_code);

       $query = $this->db->get();
       return $query->row();
  }
  public function viewStokesDedatil($sl_code){
         $this->db->select('tbl_sold.*, tbl_product.p_name, tbl_product.p_code,tbl_product.p_price,tbl_product.p_qty,tbl_category.cat_name, tbl_subcategory.sub_name,tbl_customers.c_name,tbl_customers.c_phone,tbl_customers.c_address');

        $this->db->from('tbl_sold');

        $this->db->join('tbl_product', 'tbl_sold.p_id = tbl_product.p_id','left');

        $this->db->join('tbl_category', 'tbl_product.p_cat=tbl_category.id','left');

        $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id','left');

        $this->db->join('tbl_customers', 'tbl_customers.c_id = tbl_sold.c_id', 'left');

        $this->db->where('tbl_sold.sl_code', $sl_code);

        $query = $this->db->get();
        return $query->result();
  } 
}