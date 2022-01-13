<?php
/**
 * 
 */
class Subcategory extends CI_Controller
{
	
   public function __construct() 
   {
      parent::__construct();
      $this->load->library('breadcrumb');
      $this->load->model('categoryModel'); 
      $this->load->model('SubcategoryModel');
      $this->load->helper('form');
   }

   public function addSubcategory()
   {
      // Add items
      $breadcrumb_items = [
         'Home' => '/',
         'Subcategory' => 'category/subcategory'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];
      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['cats'] = $this->categoryModel->allCategory();

      $data['headertitle'] = 'Category';

      $this->load->view("admin/headers/category/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/subcat/subcat");
      $this->load->view("admin/footers/subcat/footer",$data);
   }


    public function ajax_add()
    {
         $data = array(
                'id' => trim($this->input->post('id')),
                'sub_name' => trim($this->input->post('sub_name'))
            );

         $insert = $this->SubcategoryModel->save($data);
         echo json_encode(array("status" => TRUE));
    }


    public function list_subcategory(){
        $this->load->model("SubcategoryModel");
        $list = $this->SubcategoryModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ko) {
            $no++;
            $row = array();
            $row[] = $ko->sub_name;
            $row[] = $ko->cat_name;
            //$row[] = $ko->sub_name;


            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_category('."'".$ko->sub_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="subcat_delete('."'".$ko->sub_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SubcategoryModel->count_all(),
            "recordsFiltered" => $this->SubcategoryModel->count_filtered(),
            "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }


    public function ajax_edit($id)
    {
        $data = $this->SubcategoryModel->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $data = array(
                'id' => trim($this->input->post('cateogry')),
                'sub_name' => trim($this->input->post('sub_name'))
            );
        $this->SubcategoryModel->update(array('sub_id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->SubcategoryModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}