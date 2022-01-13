<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class productModel extends CI_Model {
 
  var $table = 'tbl_product';

  var $tbl_subcategory = 'tbl_subcategory';

  var $tbl_category = 'tbl_category';
  // var $column_order = array('cat_name','date',null); //set column field database for datatable orderable
  // var $column_search = array('cat_name','date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('p_id' => 'desc'); // default order 

  public function __construct()
  {
      parent::__construct();
     //$this->load->database();
  }



  private function _get_datatables_query($term=''){ //term is value of $_REQUEST['search']['value']
      $column = array('tbl_product.p_name','tbl_product.sub_id','tbl_subcategory.sub_name');
      $this->db->select('tbl_product.*,tbl_product.p_name,tbl_product.p_code,tbl_product.p_price,tbl_product.p_date,tbl_product.p_img,tbl_product.p_des, tbl_subcategory.sub_id,tbl_subcategory.sub_name,tbl_category.cat_name');
      $this->db->from('tbl_product');
      //$this->db->from('tbl_subcategory');
      $this->db->join('tbl_category', 'tbl_category.id = tbl_product.p_cat','left');
      $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.id','left');
      $this->db->like('tbl_subcategory.sub_name', $term);
      $this->db->or_like('tbl_category.cat_name', $term);
      $this->db->or_like('tbl_product.p_name', $term);
      $this->db->or_like('tbl_product.p_code', $term);
      $this->db->or_like('tbl_product.p_price', $term);
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



  public function allCategory()
  {
      $query = $this->db->get('tbl_category');
      return $query->result();
  }

	public function save($data)
	{
        return $this->db->insert($this->table, $data);
	}

	public function productCodeExsits($p_code)
	{
        $this->db->where('p_code',$p_code);
        $query=$this->db->get($this->table);
        return $query->num_rows();

	}

  public function productList()
  {

        // $this->db->select('*');
        // $this->db->from($this->table);
        // $this->db->order_by('id', 'DESC');
        // $query = $this->db->get();
        // return $query->result();
        
        // $query = $this->db->get($this->table);
        // $this->db->order_by('title', 'DESC');
        // return $query->result(); 

        $this->db->select('tbl_product.*, tbl_category.cat_name');
        $this->db->from('tbl_product');
        $this->db->join('tbl_category', 'tbl_category.id = tbl_product.p_cat');
        $this->db->order_by('tbl_product.p_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
  }

  public function viewproductbyid($id)
  {
       $this->db->select('tbl_product.*, tbl_category.cat_name,tbl_subcategory.sub_name');
       $this->db->from('tbl_product');
       $this->db->join('tbl_category', 'tbl_category.id = tbl_product.p_cat', 'left');
       $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id', 'left');
       $this->db->where('tbl_product.p_id', $id);
       $query = $this->db->get();
       return $query->row();
  }

  public function productUpdate($data,$id)
  {
       return $this->db->update($this->table, $data, array('p_id' => $id));
  }

  public function getImgById($id)
  {
       return $this->db->get_where($this->table, array('p_id' => $id))->row();
  }

  public function productdelete($id)
  {
       $this->db->where('p_id', $id);
       return $this->db->delete($this->table);
  }

  public function fetch_data($query)
  {

       $this->db->select('tbl_product.*, tbl_category.cat_name,tbl_category.id,tbl_subcategory.sub_id');
       $this->db->from('tbl_product');
       $this->db->join('tbl_category', 'tbl_category.id = tbl_product.p_cat');
       $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id','left');
       $this->db->where('tbl_product.p_code', $query);
       $this->db->limit(1);
       return $this->db->get();
    
      //  $this->db->select("*");
      //  $this->db->from($this->table);
      //  if($query != '')
      //  {
      //   $this->db->where('p_code', $query);
      //  }
      // //$this->db->order_by('CustomerID', 'DESC');
      //  $this->db->limit(1);
      //  return $this->db->get();
  }

 public function fetch_subcat($id)
 {

  $this->db->select('tbl_subcategory.sub_id, tbl_subcategory.id,tbl_subcategory.sub_name');
  $this->db->from('tbl_subcategory');
  $this->db->join('tbl_category', 'tbl_category.id = tbl_subcategory.id','left');
  $this->db->where('tbl_subcategory.id', $id);
  $this->db->order_by('tbl_subcategory.sub_id', 'ASC');
  $query = $this->db->get();

  $data = $query->result();

  $output = '<option value="0">Select Subcategory</option>';

  if (!empty($data)) {
  foreach($data as $row)
  {
   $output .= '<option value="'.$row->sub_id.'">'.$row->sub_name.'</option>';
  }  
 }else{
   $output = '<option value="0" style="color:gray">No Subcategory</option>';
 }


  return $output;
 }

 public function fetch_subcat_prodcut($id){


  $this->db->from('tbl_product');
  $this->db->where('p_id',$id);
  $query = $this->db->get();

 $data = $query->result();

foreach ($data as $val) {
  $sub_cat_id = $val->p_cat;
}

  // $this->db->select('tbl_subcategory.*, tbl_product.id,tbl_product.p_sub_cat');
  // $this->db->from('tbl_subcategory');
  // $this->db->join('tbl_product', 'tbl_subcategory.sub_id=tbl_product.p_sub_cat','left');
  // $this->db->where('tbl_subcategory.sub_id', $sub_cat_id);
  // $this->db->order_by('tbl_subcategory.sub_id', 'ASC');
  // $query = $this->db->get();
  // return $query->result();


  $this->db->select('tbl_subcategory.sub_id, tbl_subcategory.id,tbl_subcategory.sub_name');
  $this->db->from('tbl_subcategory');
  $this->db->join('tbl_category', 'tbl_category.id = tbl_subcategory.id','left');
  $this->db->where('tbl_subcategory.id', $sub_cat_id);
  $this->db->order_by('tbl_subcategory.sub_id', 'ASC');
  $query = $this->db->get();

  return $data = $query->result();

 //  $output = '<option value="">Select Subcategory</option>';

 //  if (!empty($data)) {
 //  foreach($data as $row)
 //  {
 //   $output .= '<option value="'.$row->sub_id.'">'.$row->sub_name.'</option>';
 //  }  
 // }else{
 //   $output = '<option value="" style="color:gray">No Subcategory</option>';
 // }


 //  return $output;
 }

 public function allsubcategory(){
      $query = $this->db->get('tbl_subcategory');
      return $query->result();

 }

}