<?php
/**
 * Report Controller
 */
class Report extends CI_Controller
{
	
   public function __construct() 
   {
      parent::__construct();
      $this->load->library('breadcrumb');
      $this->load->model('productModel'); 
      $this->load->model('reportModel'); 
   }


   public function report()
   {
      $breadcrumb_items = [
         'Home' => '/',
         'Date base report' => 'report/report'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Report | SMWA';

      $data['date'] = date("Y-m-d");

      $this->load->view("admin/headers/header/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/report/report",$data);
      $this->load->view("admin/footers/report/footer");
   }

    public function list_sell(){
        $list = $this->reportModel->get_datatables();

        

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
        	$date =  date("Y-m-d",strtotime($value->sl_datetime));
        	
            $no++;
            $row = array();
            $row[] = date("j M Y", strtotime($value->sl_datetime));
  
            //add html for action
            $row[] = '
               <a href="'.base_url('Report/reportByDate/'.$date).'" class="btn bg-gradient-info btn-flat">View Report</a>      
            ';
            $data[] = $row;

        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->reportModel->count_all(),
            "recordsFiltered" => $this->reportModel->count_filtered(),
            "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }

    public function reportByDate($date){
       $breadcrumb_items = [
         'Home' => '/',
         'Date base report' => 'report/report'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Report by date | SMWA';

      $data['reportbydate'] = $this->reportModel->reportbydate($date);


      $this->load->view("admin/headers/header/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/report/reportbydate",$data);
      $this->load->view("admin/footers/report/footer");
    }

    public function weeklyReport(){

    }
} 