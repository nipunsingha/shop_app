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

   public function stokes_list(){
        $this->load->model('stokesModel');
        $list = $this->stokesModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ko) {
            $no++;
            $row = array();
            if(!empty($ko->p_img)){
            $row[] = '
                    <td><img src="'.base_url().$ko->p_img.'" class="img-responsive img-thumbnail"></td>
                    ';
                  }else{
            $row[] = '
                    <td><img src="'.base_url().'webroot/dist/img/no-pic.png" class="img-responsive img-thumbnail"></td>
                    ';
                  }

            $row[] = $ko->p_name;
            $row[] = $ko->cat_name;
            $row[] = $ko->p_code;
            $row[] = $ko->p_price;
            $row[] = $ko->p_qty;
            //add html for actio
        
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->stokesModel->count_all(),
            "recordsFiltered" => $this->stokesModel->count_filtered(),
            "data" => $data,
            );
        //output to json format
        echo json_encode($output);
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