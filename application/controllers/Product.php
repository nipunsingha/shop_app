<?php
/**
 * Product Controller
 */
class Product extends CI_Controller
{
	
   public function __construct() 
   {
      parent::__construct();
      $this->load->library('breadcrumb');
      //$this->load->helper('form');
      //$this->load->library('form_validation');
      $this->load->model('productModel'); 
   }

   public function addProduct()
   {
      $breadcrumb_items = [
         'Home' => '/',
         'Add Product' => 'category/category'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Add Product';

      $data['cats'] = $this->productModel->allCategory();
 
      $this->load->view("admin/headers/product/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/product/addproduct",$data);
      $this->load->view("admin/footers/product/footer");
   }

   public function fetch_subcat(){
      if($this->input->post('sub_id'))
      {
       echo $this->productModel->fetch_subcat($this->input->post('sub_id'));
      }
   }


   public function insertProduct()
   {
  	  $this->form_validation->set_rules('p_name', 'product name', 'trim|required');
  	  $this->form_validation->set_rules('p_cat', 'category', 'trim|required');
  	  $this->form_validation->set_rules('p_code', 'code', 'trim|required|is_unique[tbl_product.p_code]',array('is_unique' => 'This %s already exists.'));
  	  $this->form_validation->set_rules('p_price', 'price', 'trim|required');
  	  $this->form_validation->set_rules('p_date', 'date', 'trim|required');

    if(!empty($_FILES['p_img']['name']))
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $new_name = substr(md5(time()), 0, 10);
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);

        if ($this->form_validation->run() && $this->upload->do_upload('p_img'))
        {
        
         $data = $this->upload->data();
         $name = $data['raw_name'];
         $img_path = "uploads/".$name.$data['file_ext'];

         // $p_date = trim($this->input->post('p_date'));
         // $date=date('Y-m-d',strtotime($p_date));
         $data = array(
                'p_name' => trim($this->input->post('p_name')),
                'p_cat' => trim($this->input->post('p_cat')),
                'p_sub_cat' => trim($this->input->post('p_sub_cat')),
                'p_code' => trim($this->input->post('p_code')),
                'p_price' => trim($this->input->post('p_price')),
                'p_date' => $this->input->post('p_date'),
                'p_img' => trim($img_path),
                'p_des' => trim($this->input->post('p_des')),
            );
         $insert = $this->productModel->save($data);
         $this->session->set_flashdata('msg', 'Product added successfully');
         if ($insert) {
           redirect(base_url('product/productlist'));
         }
        }
        else
        {

         $breadcrumb_items = [
           'Home' => '/',
           'Add Product' => 'category/category'
        ];
        $template = [
           'tag_open' => '<ol class="breadcrumb float-sm-right">',
           'crumb_open' => '<li class="breadcrumb-item">',
           'crumb_active' => '<li class="breadcrumb-item active">'
        ];

        $this->breadcrumb->set_template($template);
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['error'] = $this->upload->display_errors();

        $data['headertitle'] = 'Add Product';

        $data['cats'] = $this->productModel->allCategory();

        $this->load->view("admin/headers/product/header",$data);
        $this->load->view("admin/sidebar");
        $this->load->view("admin/product/addproduct",$data);
        $this->load->view("admin/footers/product/footer");
        }
     }else{
        if ($this->form_validation->run())
        {
        
         $data = array(
                'p_name' => trim($this->input->post('p_name')),
                'p_cat' => trim($this->input->post('p_cat')),
                'p_sub_cat' => trim($this->input->post('p_sub_cat')),
                'p_code' => trim($this->input->post('p_code')),
                'p_price' => trim($this->input->post('p_price')),
                'p_date' => $this->input->post('p_date'),
                'p_des' => trim($this->input->post('p_des')),
            );
         $insert = $this->productModel->save($data);
         $this->session->set_flashdata('msg', 'Product added successfully');
         if ($insert) {
           redirect(base_url('product/productlist'));
         }
        }
        else
        {

         $breadcrumb_items = [
           'Home' => '/',
           'Add Product' => 'category/category'
        ];
        $template = [
           'tag_open' => '<ol class="breadcrumb float-sm-right">',
           'crumb_open' => '<li class="breadcrumb-item">',
           'crumb_active' => '<li class="breadcrumb-item active">'
        ];

        $this->breadcrumb->set_template($template);
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['headertitle'] = 'Add Product';

        $data['cats'] = $this->productModel->allCategory();

        $this->load->view("admin/headers/product/header",$data);
        $this->load->view("admin/sidebar");
        $this->load->view("admin/product/addproduct",$data);
        $this->load->view("admin/footers/product/footer");

        }
      }

   }

  public function productCodeExsits()
  {
      $p_code=trim($this->input->post('p_code'));
      $result=$this->productModel->productCodeExsits($p_code);
      if($result)
      {
        echo 'false';
      }
      else
      {
          echo'true';
      } 
  }

  public function productList()
  {
       $breadcrumb_items = [
         'Home' => '/',
         'Product List' => 'category/category'
      ];
      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];
      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Product List';

      $data['productlist'] = $this->productModel->productList();

      $this->load->view("admin/headers/category/header",$data);
      $this->load->view("admin/sidebar");
      //$this->load->view("admin/product/productlist",$data);
      $this->load->view("admin/product/listproduct",$data);
      $this->load->view("admin/footers/product/footer");
  }

  public function list_product(){
        $this->load->model("productModel");
        $list = $this->productModel->get_datatables();
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
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" id="view" onclick="productview('."'".$ko->p_id."'".')"><i class="glyphicon glyphicon-pencil"></i>View</a>

              <a class="btn btn-sm btn-success" href="'.base_url('Product/productedit/'.$ko->p_id).'">Edit</a>

              <a class="btn btn-sm btn-danger" onclick="return delete_confirm()" href="'.base_url('Product/productdelete/'.$ko->p_id).'">Delete</a>';
        
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->productModel->count_all(),
            "recordsFiltered" => $this->productModel->count_filtered(),
            "data" => $data,
            );
        //output to json format
        echo json_encode($output);
  }

  public function viewproductbyid($id)
  {
    $results= $this->productModel->viewproductbyid($id);
    $data['p_name'] = $results->p_name;
    $data['cat_name'] = $results->cat_name;
    $data['p_code'] = $results->p_code;
    if ($results->p_sub_cat == "0") {
      $data['p_sub_cat'] = "No Subcategory";
    }else{
      $data['p_sub_cat'] = $results->sub_name;
    }
    
    $data['p_price'] =  "<div>".$results->p_price." ৳</div>";
    $data['p_des'] = $results->p_des;
    $data['p_date'] = $results->p_date;
    
    if($results->p_img){
       $data['p_img'] = '<div class="text-center mb-3"><img class=" img-thumbnail" src="'.base_url($results->p_img).'" width="250" height="250" ></div>';
    }
    else
    {
      $data['p_img'] = '<div class="text-center mb-3"><img class="img-thumbnail" width="250" height="350" src="'.base_url('webroot/dist/img/no-pic.png"').'"></div>';
    }
        
  echo json_encode($data);

  }

  public function productedit($id)
  {
      $data['item']= $this->productModel->viewproductbyid($id);

      $data['subcat']= $this->productModel->fetch_subcat_prodcut($id);

       $breadcrumb_items = [
         'Home' => '/',
         'Product List' => 'product/productlist',
          $data['item']->p_name => $data['item']->p_name
      ];
      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Edit Product';

      $data['cats'] = $this->productModel->allCategory();
      $data['sub_cats'] = $this->productModel->allsubcategory();

      $this->load->view("admin/headers/product/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/product/editproduct",$data);
      $this->load->view("admin/footers/editproduct/footer");
  }

  // public function fetch_subcat_prodcut(){
  //     if($this->input->post('sub_id'))
  //     {
  //      echo $this->productModel->fetch_subcat_prodcut($this->input->post('sub_id'));
  //     }
  // } 

  public function productUpdate($id)
  {
      $this->form_validation->set_rules('p_name', 'product name', 'trim|required');
      $this->form_validation->set_rules('p_cat', 'category', 'trim|required');
      $this->form_validation->set_rules('p_code', 'code', 'trim|required');
      $this->form_validation->set_rules('p_price', 'price', 'trim|required');
      $this->form_validation->set_rules('p_date', 'date', 'trim|required');

      $data['item']= $this->productModel->viewproductbyid($id);

    if(!empty($_FILES['p_img']['name']))
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $new_name = substr(md5(time()), 0, 10);
        $config['file_name'] = $new_name;

        $img =$this->productModel->getImgById($id); 
        $old_img = $img->p_img;

        $this->load->library('upload', $config);

        if ($this->form_validation->run() && $this->upload->do_upload('p_img'))
        {

         $data = $this->upload->data();
         $name = $data['raw_name'];
         $img_path = "uploads/".$name.$data['file_ext'];

         // $p_date = trim($this->input->post('p_date'));
         // $date=date('Y-m-d',strtotime($p_date));
         $data = array(
                'p_name' => trim($this->input->post('p_name')),
                'p_cat' => trim($this->input->post('p_cat')),
                'p_code' => trim($this->input->post('p_code')),
                'p_price' => trim($this->input->post('p_price')),
                'p_date' => $this->input->post('p_date'),
                'p_img' => trim($img_path),
                'p_des' => trim($this->input->post('p_des')),
                'p_sub_cat' => trim($this->input->post('p_sub_cat')),
            );


          if (!empty($old_img))
          {
              unlink($old_img);
          }

         $insert = $this->productModel->productUpdate($data,$id);
         $this->session->set_flashdata('msg', 'Product updated successfully');
         if ($insert) {
           redirect(base_url('product/productlist'));
         }
        }
        else
        {

         $breadcrumb_items = [
           'Home' => '/',
           'Product List' => 'product/productlist',
           $data['item']->p_img => 'product/productlist/'.$data['item']->id
        ];
        $template = [
           'tag_open' => '<ol class="breadcrumb float-sm-right">',
           'crumb_open' => '<li class="breadcrumb-item">',
           'crumb_active' => '<li class="breadcrumb-item active">'
        ];

        $this->breadcrumb->set_template($template);
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

        $data['error'] = $this->upload->display_errors();

        $data['headertitle'] = 'Add Product';

        $data['cats'] = $this->productModel->allCategory();

        $this->load->view("admin/headers/product/header",$data);
        $this->load->view("admin/sidebar");
        $this->load->view("admin/product/editproduct",$data);
        $this->load->view("admin/footers/editproduct/footer");
        }
     }else{
        if ($this->form_validation->run())
        {
        
         $data = array(
                'p_name' => trim($this->input->post('p_name')),
                'p_cat' => trim($this->input->post('p_cat')),
                'p_code' => trim($this->input->post('p_code')),
                'p_price' => trim($this->input->post('p_price')),
                'p_date' => $this->input->post('p_date'),
                'p_des' => trim($this->input->post('p_des')),
                'p_sub_cat' => trim($this->input->post('p_sub_cat')),
            );
         $insert = $this->productModel->productUpdate($data,$id);
         $this->session->set_flashdata('msg', 'Product updated successfully');
         if ($insert) {
           redirect(base_url('product/productlist'));
         }
        }
        else
        {

         $breadcrumb_items = [
           'Home' => '/',
           'Product List' => 'product/productlist',
           $data['item']->p_img => 'product/productlist/'.$data['item']->id
        ];
        $template = [
           'tag_open' => '<ol class="breadcrumb float-sm-right">',
           'crumb_open' => '<li class="breadcrumb-item">',
           'crumb_active' => '<li class="breadcrumb-item active">'
        ];

        $this->breadcrumb->set_template($template);
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();      
        $data['headertitle'] = 'Edit Product';
        $data['cats'] = $this->productModel->allCategory();
        $this->load->view("admin/headers/product/header",$data);
        $this->load->view("admin/sidebar");
        $this->load->view("admin/product/editproduct",$data);
        $this->load->view("admin/footers/editproduct/footer");

        }
      }  
  }


  public function productdelete($id)
  {
    $img =$this->productModel->getImgById($id); 
    $old_img = $img->p_img;
    if (!empty($old_img))
    {
        unlink($old_img);
    }
    $result = $this->productModel->productdelete($id);
    $this->session->set_flashdata('msg', 'Product Deleted successfully');
     if ($result) {
       redirect(base_url('product/productlist'));
     }
  }
} 