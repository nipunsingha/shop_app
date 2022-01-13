<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class reportModel extends CI_Model {
 
    var $table = 'tbl_sell';

    var $order = array('sl_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
       //$this->load->database();
    }
    



    private function _get_datatables_query($term=''){ //term is value of $_REQUEST['search']['value']
        $column = array('sl_datetime');

        $this->db->select('tbl_sold.*');

        $this->db->from('tbl_sold');

        $this->db->like('sl_datetime', $term);

        //$this->db->group_by(DATE_FORMAT('sl_datetime', '%Y%m%d'));
        $this->db->group_by('MONTH(sl_datetime), YEAR(sl_datetime),DAY(sl_datetime)');
        $this->db->order_by('sl_datetime', 'DESC');

        // $this->db->or_like('p.nm_propinsi', $term);
        if(isset($_REQUEST['order'])) // here order processing
        {
           $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables(){
      $term = $_REQUEST['search']['value'];   
      $this->_get_datatables_query($term);
      if($_REQUEST['length'] != -1)
      $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
      $query = $this->db->get();
      return $query->result(); 
    }

    function count_filtered(){
      $term = $_REQUEST['search']['value']; 
      $this->_get_datatables_query($term);
      $query = $this->db->get();
      return $query->num_rows();  
    }

    public function count_all(){
      $this->db->from($this->table);
      return $this->db->count_all_results();  
    }

    public function reportbydate($date){
         $this->db->select('tbl_sold.*, tbl_product.p_name, tbl_product.p_code,tbl_product.p_price,tbl_category.cat_name, tbl_subcategory.sub_name,tbl_customers.c_name,tbl_customers.c_phone,tbl_customers.c_address');

        $this->db->from('tbl_sold');

        $this->db->join('tbl_product', 'tbl_sold.p_id = tbl_product.p_id','left');

        $this->db->join('tbl_category', 'tbl_product.p_cat=tbl_category.id','left');

        $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id','left');

        $this->db->join('tbl_customers', 'tbl_customers.c_id = tbl_sold.c_id', 'left');

        $this->db->where('tbl_sold.sl_date', $date);

        $query = $this->db->get();
        return $query->result();
    }

}