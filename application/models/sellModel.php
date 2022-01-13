<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class sellModel extends CI_Model {
 
    var $table = 'tbl_sell';

    var $order = array('sl_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
       //$this->load->database();
    }
    



    private function _get_datatables_query($term=''){ //term is value of $_REQUEST['search']['value']
        $column = array('tbl_subcategory.sub_id','tbl_subcategory.sub_name');

        $this->db->select('tbl_sold.*, tbl_product.p_name, tbl_product.p_code,tbl_product.p_price, tbl_category.cat_name, tbl_subcategory.sub_name');

        $this->db->from('tbl_sold');

         $this->db->join('tbl_product', 'tbl_sold.p_id = tbl_product.p_id', 'left');

        $this->db->join('tbl_category', 'tbl_product.p_cat=tbl_category.id', 'left');

        $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id', 'left');

        $this->db->like('tbl_subcategory.sub_name', $term);
        $this->db->or_like('tbl_category.cat_name', $term);
        $this->db->or_like('tbl_sold.sl_datetime', $term);

        $this->db->group_by(array("tbl_sold.sl_token"));
        $this->db->order_by('tbl_sold.sl_id', 'DESC');

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




    public function insertSell($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function insertEditSell($data,$token)
    {
        //$this->db->where($token, 'sl_token');
        return $this->db->insert('tbl_sold', $data);
    }

    public function codeExists($sl_code) 
    {

    // $this->db->select('*'); 
    // $this->db->from($this->table);
    // $this->db->where('s_code', $s_code);
    // $query = $this->db->get();
    // $result = $query->result_array();
    // return $result;

        $this->db->where('sl_code',$sl_code);
        $query=$this->db->get('tbl_sold');
        return $query->num_rows();
    }

    public function codeExistsSell($sl_code,$sl_token)
    {
        $this->db->where('sl_code',$sl_code);
        $this->db->where('sl_token',$sl_token);
        $query=$this->db->get('tbl_sold');
        return $query->num_rows(); 
    }


    public function cartExistsSell($sl_code)
    {
        $this->db->where('sl_code',$sl_code);
        $query=$this->db->get('tbl_sold');
        return $query->num_rows(); 
    }

    public function sellItem()
    {
        $this->db->select('tbl_sell.*, tbl_category.cat_name');
        $this->db->from('tbl_sell');
        $this->db->join('tbl_category', 'tbl_category.id = tbl_sell.s_cat');
        $this->db->where('tbl_sell.sold', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function delete_item_by_id($id)
    {
        $this->db->where('sl_id', $id);
        return $this->db->delete('tbl_sold');
    }

    public function insertSaleItem($data)
    {   
        return $this->db->insert_batch('tbl_sold', $data);
    }

    public function update_sell($data)
    {
       return $this->db->update('tbl_sell', $data);
    }

    public function sellList()
    {

        $this->db->select('tbl_sold.*, tbl_product.p_name, tbl_product.p_code,tbl_product.p_price, tbl_category.cat_name, tbl_subcategory.sub_name');

        $this->db->from('tbl_sold');

        $this->db->join('tbl_product', 'tbl_sold.p_id = tbl_product.p_id', 'left');

        $this->db->join('tbl_category', 'tbl_product.p_cat=tbl_category.id', 'left');

        $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id', 'left');

        $this->db->group_by(array("tbl_sold.sl_token"));
        $this->db->order_by('tbl_sold.sl_id', 'DESC');
        $query = $this->db->get();
        return $query->result();


    //     $this->db->select('*');
    //     $this->db->from('tbl_sold');
    //     $this->db->group_by(array("sl_token"));
    //     $this->db->order_by('sl_id', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // 
    }

    public function sellDetail($token)
    {

        $this->db->select('tbl_sold.*, tbl_product.p_name, tbl_product.p_code,tbl_product.p_price,tbl_category.cat_name, tbl_subcategory.sub_name,tbl_customers.c_name,tbl_customers.c_phone,tbl_customers.c_address');

        $this->db->from('tbl_sold');

        $this->db->join('tbl_product', 'tbl_sold.p_id = tbl_product.p_id','left');

        $this->db->join('tbl_category', 'tbl_product.p_cat=tbl_category.id','left');

        $this->db->join('tbl_subcategory', 'tbl_product.p_sub_cat = tbl_subcategory.sub_id','left');

        $this->db->join('tbl_customers', 'tbl_customers.c_id = tbl_sold.c_id', 'left');

        $this->db->where('tbl_sold.sl_token', $token);
        $query = $this->db->get();
        return $query->result();




       // $this->db->select('*');
       // $this->db->from('tbl_sold');
       // $this->db->join('tbl_category', 'tbl_category.id = tbl_sold.sl_cat', 'left');
       // $this->db->join('tbl_customers', 'tbl_customers.c_id = tbl_sold.c_id', 'left');
       // $this->db->where('tbl_sold.sl_token', $token);

       // $query = $this->db->get();
       // return $query->result();
    

    }

    public function delete_by_token($token)
    {
        $this->db->where('sl_token', $token);
        $this->db->delete('tbl_sold');
    }



    public function deleteEditeItem($id)
    {
        $this->db->where('sl_id', $id);
        $this->db->delete('tbl_sold'); 
    }

    // public function update_grandTotal($data1,$sl_token)
    // {
    //     $this->db->where('sl_token', $sl_token); 
    //     return $this->db->update('tbl_sold', $data1);
    // }

    public function editSellItem($token)
    {
        $this->db->select('*');
        $this->db->from('tbl_sold');
        $this->db->join('tbl_category', 'tbl_category.id = tbl_sold.sl_cat');
        $this->db->join('tbl_customers', 'tbl_customers.c_id = tbl_sold.c_id', 'left');
        $this->db->where('sl_token', $token);
        $query = $this->db->get();
        return $query->result();
    }

    public function sellItemEdit($token)
    {
        $this->db->select('tbl_sold.*, tbl_category.cat_name');
        $this->db->from('tbl_sold');
        $this->db->join('tbl_category', 'tbl_category.id = tbl_sold.sl_cat');
        $this->db->where('sl_token', $token);
        $query = $this->db->get();
        return $query->result();  
    }

    public function insertEditSaleItem($data,$token)
    {
        $this->db->where('sl_token', $token);
        $this->db->update('tbl_sold',$data);
    }

    public function fetchEditSellItem($token)
    {
        $this->db->select('tbl_sold.*, tbl_category.cat_name');
        $this->db->from('tbl_sold');
        $this->db->join('tbl_category', 'tbl_category.id = tbl_sold.sl_cat');
        $this->db->where('sl_token', $token);
        $query = $this->db->get();
        return $query->result();    
    }

    public function fetchDeleteSellItem($id)
    {
        $this->db->select('tbl_sold.*, tbl_category.cat_name');
        $this->db->from('tbl_sold');
        $this->db->join('tbl_category', 'tbl_category.id = tbl_sold.sl_cat');
        $this->db->where('tbl_sold.sl_id', $id);
        $query = $this->db->get();
        return $query->result();   
    }

    public function updateSellPrice($data,$sl_token)
    {
        $this->db->where('sl_token', $sl_token);
        $this->db->update('tbl_sold',$id);
    }

    public function getCustomers($searchTerm)
    {
     $this->db->select('*');
     $this->db->where("c_name like '%".$searchTerm."%' or c_phone like '%".$searchTerm."%'");
     $this->db->limit(1);
     return $this->db->get('tbl_customers');
    }

    public function customerListSearch($search){
     // Fetch users
     $this->db->select('*');
     $this->db->where("c_name like '%".$search."%' or c_phone like '%".$search."%'");
     $fetched_records = $this->db->get('tbl_customers');
     $users = $fetched_records->result_array();

     // Initialize Array with fetched data
     $data = array();
     foreach($users as $user){
        $data[] = array("id"=>$user['c_id'], "text"=>$user['c_name']);
     }
     return $data;
    }


    public function updateQnty($token,$quantity,$p_id){

        $this->db->where('sl_token',$token);
        $this->db->where('p_id',$p_id);
        $query=$this->db->get('tbl_sold');
        return $query->num_rows(); 

        // $this->db->select('*');
        // $this->db->from('tbl_sold');
        // $this->db->where("sl_token like '%".$token."%' or sl_qty like '%".$quantity."%' or p_id like '%".$p_id."%'");
        // return $num_results = $this->db->count_all_results();
    }

    public function updateQuantity($data,$p_id,$token){
     return $this->db->update('tbl_sold', $data, array('p_id' => $p_id,'sl_token' => $token));
    }

    public function fetchQty($token,$quantity,$p_id){
        $this->db->select('*'); 
        $this->db->from('tbl_sold');
        $this->db->where('p_id', $p_id);
        $this->db->where('sl_token', $token);
        $query = $this->db->get();
        return $query->result();
    }

    public function updateSlqty($token,$sl_qty,$p_id,$data){
     return $this->db->update('tbl_sold', $data, array('p_id' => $p_id,'sl_token' => $token)); 
    }

    public function undateComment($token,$comment,$data){
     return $this->db->update('tbl_sold', $data, array('sl_token' => $token));  
    }
    public function updateDiscount($token,$data){
     return $this->db->update('tbl_sold', $data, array('sl_token' => $token));  
    }
    public function updatePay($token,$data){
     return $this->db->update('tbl_sold', $data, array('sl_token' => $token));  
    }
    public function updateCustomer($token,$data){
     return $this->db->update('tbl_sold', $data, array('sl_token' => $token));  
    }
}    

