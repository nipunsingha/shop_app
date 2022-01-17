<?php
/**
 * 
 */
class Category extends CI_Controller
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
      $this->load->helper('form');
   }

   public function addCategory()
   {
      // Add items
      $breadcrumb_items = [
         'Home' => '/',
         'Category' => 'category/category'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];
      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Category';

      $this->load->view("admin/headers/category/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/category/category",$data);
      $this->load->view("admin/footers/category/footer");
   }


    public function cateList()
    {
        $list = $this->categoryModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cat) {
            $no++;
            $row = array();
            $row[] = $cat->cat_name;
            //$row[] = $cat->date;
 
            //add html for action
            $row[] = '<a class="btn bg-gradient-info btn-flat" href="javascript:void(0)" title="Edit" onclick="edit_category('."'".$cat->id."'".')"><i class="fas fa-pen"></i></a>
                  <a class="btn bg-gradient-danger btn-flat" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cat->id."'".')"><i class="far fa-trash-alt"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->categoryModel->count_all(),
                        "recordsFiltered" => $this->categoryModel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    public function ajax_add()
    {
         $data = array(
                'cat_name' => trim($this->input->post('cat_name')),
            );
         $cat_name=trim($this->input->post('cat_name'));
         $result=$this->categoryModel->tagExists($cat_name);
         if($result>0)
         {
          echo 1;
          exit();  
         }

         $insert = $this->categoryModel->save($data);
         echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data = $this->categoryModel->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $data = array(
                'cat_name' => $this->input->post('cat_name'),
            );
        $this->categoryModel->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->categoryModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
?>