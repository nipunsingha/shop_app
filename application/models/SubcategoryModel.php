<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class SubcategoryModel extends CI_Model {
 
    var $table = 'tbl_subcategory';
    // var $column_order = array('cat_name','date',null); //set column field database for datatable orderable
    // var $column_search = array('cat_name','date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('sub_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
       // $this->load->database();
    }

	private function _get_datatables_query($term=''){ //term is value of $_REQUEST['search']['value']
	    $column = array('tbl_subcategory.sub_id','tbl_subcategory.sub_name');
	    $this->db->select('tbl_subcategory.sub_id, tbl_subcategory.id,tbl_subcategory.sub_name,tbl_category.cat_name');
	    $this->db->from('tbl_subcategory');
	    $this->db->join('tbl_category', 'tbl_category.id = tbl_subcategory.id','left');
	    $this->db->like('tbl_subcategory.sub_name', $term);
	    $this->db->or_like('tbl_category.cat_name', $term);
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


    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('sub_id',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('sub_id', $id);
        $this->db->delete($this->table);
    }

}