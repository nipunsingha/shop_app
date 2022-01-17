<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if (! $this->session->userdata('username'))
        {
            redirect('Login/index'); // the user is not logged in, redirect them!
        }
        $this->load->library('breadcrumb');
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
        $this->load->model('userModel');
    }

	public function index()
	{
        $breadcrumb_items = [
            'Home' => '/',
            'User' => 'User'
         ];
   
         $template = [
            'tag_open' => '<ol class="breadcrumb float-sm-right">',
            'crumb_open' => '<li class="breadcrumb-item">',
            'crumb_active' => '<li class="breadcrumb-item active">'
         ];
   
        $this->breadcrumb->set_template($template);
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
		$data['headertitle'] = 'User | SMWA';
		$this->load->view('admin/headers/header/header.php',$data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/user/user');
		$this->load->view('admin/footers/user/footer');
	}

    public function add_user(){
        $breadcrumb_items = [
            'Home' => '/',
            'User' => 'Add user'
         ];
   
         $template = [
            'tag_open' => '<ol class="breadcrumb float-sm-right">',
            'crumb_open' => '<li class="breadcrumb-item">',
            'crumb_active' => '<li class="breadcrumb-item active">'
         ];
   
        $this->breadcrumb->set_template($template);
        $this->breadcrumb->add_item($breadcrumb_items);
        $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();
        $data['headertitle'] = 'Add user | SMWA';
        $this->load->view('admin/headers/header/header.php',$data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/user/adduser');
        $this->load->view('admin/footers/user/footer');      
    }

    public function ajax_add()
    {

        // set form validation rules
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('level', 'User role', 'trim|required');

        // submit
        if ($this->form_validation->run() == TRUE)
        {
         $data = array(
                'name' => trim($this->input->post('name')),
                'username' => trim($this->input->post('username')),
                'password' =>  password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'level' => trim($this->input->post('level')),
            );

         // $username=trim($this->input->post('username'));

         // $result=$this->userModel->tagExists($username);
         // if($result>0)
         // {
         //  echo 1;
         //  exit();  
         // }

         $insert = $this->userModel->save($data);

         if ($insert) {
             redirect(base_url('User/index'));
         }

        }


    }

    public function userNameExst(){
      $username=trim($this->input->post('username'));
      $result=$this->userModel->tagExists($username);
      if($result)
      {
        echo 'false';
      }
      else
      {
          echo'true';
      } 
    }

    public function userlist(){
        $list = $this->userModel->get_datatables();
        $data = array();
        $no = $_POST['start'];


        foreach ($list as $cat) {
            $no++;
            $row = array();
            $row[] = $cat->name;
            $row[] = $cat->username;
            $row[] = $cat->level;
            //$row[] = $cat->date;
 

         if ($this->session->userdata('level')=='admin') {
            //add html for action
            $row[] = '<button class="btn bg-gradient-info btn-flat"  id="editBtnId" data-editBtnId="'.$cat->u_id.'"><i class="fas fa-pen"></i></button>

                <button class="btn bg-gradient-danger btn-flat" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cat->u_id."'".')"><i class="far fa-trash-alt"></i></button>';
        }else{
          $row[] ='x';
        }

 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->userModel->count_all(),
                        "recordsFiltered" => $this->userModel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit()
    {
        $id = $this->input->post('id');
        $data = $this->userModel->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
       $password = $this->input->post('password');
       $id = $this->input->post('updateId');
       if (empty($password)) {
        $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'level' => $this->input->post('level'),
            ); 
       }else{
        $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' =>  password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'level' => $this->input->post('level'),
            );
       }

       $result = $this->userModel->update($id, $data);

           if ($result) {
         echo"succes";
       }
    }

    public function ajax_delete($id){
        $this->userModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}