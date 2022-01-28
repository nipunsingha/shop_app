<?php
/**
 * 
 */
class Stokes extends CI_Controller
{
	
   public function __construct() 
   {
      parent::__construct();
      if (! $this->session->userdata('username'))
      {
          redirect('Login/index'); // the user is not logged in, redirect them!
      }
      $this->load->library('breadcrumb');
      $this->load->model('categoryModel'); 
      $this->load->model('stokesModel'); 
      
      $this->load->helper('form');
   }

   public function stokes(){
       // Add items
      $breadcrumb_items = [
         'Home' => '/',
         'Stokes' => 'Stokes/stokes'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];
      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['stokeslist'] = $this->stokesModel->stokeslist();

      $data['headertitle'] = 'Stokes';

      $this->load->view("admin/headers/category/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/stokes/stokes",$data);
      $this->load->view("admin/footers/stokes/footer");
   }

   public function viewStokesbyid(){
        $this->load->model('stokesModel');
        $sl_code = $this->input->get('sl_code');
        $results = $this->stokesModel->viewStokes($sl_code);
        $viewStokesDedatil = $this->stokesModel->viewStokesDedatil($sl_code);

        $total=0; 
        $remain=0; 
        foreach ($viewStokesDedatil as $key => $value) {
        if (is_numeric($value->sl_qty)) {
        $total += $value->sl_qty;

        $p_name = $value->p_name;
        $p_code = $value->p_code;
        $cat_name = $value->cat_name;
        $sub_name = $value->sub_name;
        $p_qty = $value->p_qty;
        $remain = $p_qty-$total;
      }
      }
    

        $data['p_qty'] =  $results->p_qty;
        $data['p_sell_qty'] =  $total;
        $data ['p_r_qty']=  $remain;
        echo json_encode($data);
   
 }

   public function viewstokesmodal(){

   }

   public function viewStokes($sl_code){
        // Add items
      $breadcrumb_items = [
         'Home' => '/',
         'Stokes' => 'Stokes/stokes'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];
      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['viewStokes'] = $this->stokesModel->viewStokes($sl_code);

      $data['headertitle'] = 'Stokes';

      $this->load->view("admin/headers/category/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/stokes/viewstokes",$data);
      $this->load->view("admin/footers/stokes/footer");
   }

}   