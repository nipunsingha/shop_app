<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      if (! $this->session->userdata('username'))
      {
          redirect('Login/index'); // the user is not logged in, redirect them!
      }
      $this->load->library('breadcrumb');
      $this->load->model('customerModel');	
    }


	public function Customer()
	{
      // Add items
      $breadcrumb_items = [
         'Home' => '/',
         'Add Customer' => 'Cusotmer/customer'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];
      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Add Customer';

      $this->load->view("admin/headers/customer/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/customer/addcustomer",$data);
      $this->load->view("admin/footers/customer/footer");
	}

  public function addCustomer()
  {
         $data = array(
                'c_name' => trim($this->input->post('c_name')),
                'c_phone' => trim($this->input->post('c_phone')),
                'c_address' => trim($this->input->post('c_address'))
            );

         $result=$this->customerModel->addCustomer($data);

        $nf = array('message'=>'Category added','alert-type'=>'success');

         //$this->session->set_flashdata('msg', 'Customer added successfully');
       $this->session->set_flashdata($nf);

         if ($result) {
           redirect(base_url('Customer/customerList'));
         }
  }

  public function customerMobileExsits()
  {
      $mobile = $this->input->post('c_phone');
      $result=$this->customerModel->customerMobileExsits($mobile);
      if($result)
      {
        echo 'false';
      }
      else
      {
          echo'true';
      } 
  }

  public function customerList()
  {
      $breadcrumb_items = [
         'Home' => '/',
         'Customer List' => 'Cusotmer/customerList'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];
      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Customer List';

      $data['customerlist']=$this->customerModel->customerList();

      $this->load->view("admin/headers/customer/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/customer/customerlist",$data);
      $this->load->view("admin/footers/customer/footer");
  }

  public function customerEdit($id)
  {
      $breadcrumb_items = [
         'Home' => '/',
         'Customer Edit' => 'Cusotmer/customerList'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];
      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Customer Edit';

      $data['customerdetail']=$this->customerModel->customerDetail($id);

      $this->load->view("admin/headers/customer/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/customer/customeredit",$data);
      $this->load->view("admin/footers/customer/footer");
  }

  public function updateCustomerInfo($id)
  {
         $data = array(
                'c_name' => trim($this->input->post('c_name')),
                'c_phone' => trim($this->input->post('c_phone')),
                'c_address' => trim($this->input->post('c_address'))
            );

         $result=$this->customerModel->updateCustomerInfo($data,$id);
         //$this->session->set_flashdata('msg', 'Customer Updated successfully');

        $nf = array('message'=>'Customer edited','alert-type'=>'success');

         //$this->session->set_flashdata('msg', 'Customer added successfully');
       $this->session->set_flashdata($nf);

         if ($result) {
           redirect(base_url('Customer/customerList'));
         }
  }

  public function customerDelete($id)
  {
    $result = $this->customerModel->customerDelete($id);
    //$this->session->set_flashdata('msg', 'Customer Deleted successfully');

    $nf = array('message'=>'Customer deleted','alert-type'=>'success');

     //$this->session->set_flashdata('msg', 'Customer added successfully');
   $this->session->set_flashdata($nf);

     if ($result) {
       redirect(base_url('Customer/customerList'));
     }
  }

}
