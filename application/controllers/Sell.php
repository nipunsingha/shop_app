<?php
/**
 * 
 */
class Sell extends CI_Controller
{
	
   public function __construct() 
   {
      parent::__construct();
      $this->load->library('breadcrumb');
      $this->load->model('productModel');
      $this->load->model('sellModel');
      $this->load->library('cart');
   }

   public function Sell()
   {
      $breadcrumb_items = [
         'Home' => '/',
         'Add Sell' => 'Sell/sell'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Add Sell | SMWA';

      $this->load->view("admin/headers/header/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/sell/sell");
      $this->load->view("admin/footers/sell/footer");
   }

   public function fetch()
   {

     $sl_code=trim($this->input->post('sl_code'));
     $result=$this->sellModel->codeExists($sl_code);
     $result_sell=$this->sellModel->codeExistsSell($sl_code);
     if($result>0)
     {
      echo '<p style="color: red;padding-bottom: 0px;font-size: 80%;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol""><i class="fa fa-info-circle" aria-hidden="true"></i>
          This product has already sold.</p>';
      exit();  
     }elseif ($result_sell>0) {
      echo '<p class="text-info" style="padding-bottom: 0px;font-size: 80%;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol""><i class="fa fa-info-circle" aria-hidden="true"></i>
          You have already selected this product.</p>';
      exit();
     }

	  $output = '';
	  $query = '';
	  $this->load->model('productModel');
	  if($this->input->post('sl_code'))
	  {
	   $query = $this->input->post('sl_code');
	  }
	  $data = $this->productModel->fetch_data($query);


	  $output .= '

      <div id="card-custom" class="card card-outline card-success" style="position: absolute;z-index: 999; width: 100%">
	     <div class="card-body">
            <form id="productItems">
			<table class="table borderless">
			  <thead>
			    <tr>
			      <th scope="col">Image</th>
			      <th scope="col">Name</th>
			      <th scope="col">Category</th>
			      <th scope="col">Code</th>
			      <th scope="col">Price</th>
			    </tr>
			  </thead>
			  <tbody>';
			  if($data->num_rows() > 0)
			  {
			   foreach($data->result() as $row)
			   {
			    $output .= '
			      <tr>';
                  if($row->p_img){
                  	$output .= '
			       <td style="cursor: pointer;"><img class="img-responsive img-thumbnail" width="60" height="60" src="'.base_url($row->p_img).'"></td>';
			        }else{
                  	$output .= '
			       <td style="cursor: pointer;"><img class="img-responsive img-thumbnail" width="60" height="60" src="'.base_url('webroot/dist/img/no-pic.png"').'"></td>';
			        }
             $output .= '
			       <td style="cursor: pointer;"><input type="text" name="s_name" value="'.$row->p_name.'" readonly></td>
			       <td style="cursor: pointer;"><input type="text" value="'.$row->cat_name.'" readonly>
             <input type="hidden" name="s_cat" value="'.$row->p_cat.'">
			       </td>
			       <td style="cursor: pointer;"><input type="text" name="s_code" value="'.$row->p_code.'" readonly></td>
			       <td style="cursor: pointer;"><input type="text" name="s_price" value="'.$row->p_price.'" readonly></td>
			      </tr>
			      <tr>
			      <td colspan="10">
              <button class="btn btn-block bg-gradient-info btn-flat">Add</button>
			      </td>
			      </tr>
			    ';
			   }
			  }
			  else
			  {
			   $output .= '<tr>
			       <td colspan="10">No Data Found</td>
			      </tr>';
			  }
	  $output .= '</tbody>
            </form>
	     </div>
	   </div>';

	    echo $output;
	 }

	 public function addSellAjax($id)
	 {
	    $results= $this->productModel->viewproductbyid($id);
	    $data['p_name'] = $results->p_name;
	    $data['cat_name'] = $results->cat_name;
	    $data['p_cat'] = $results->p_cat;
	    $data['p_code'] = $results->p_code;
	    $data['p_price'] =  $results->p_price;
        
      echo json_encode($data);
	 }

	 public function insertSell(){
        $data = array(
            's_name' => trim($this->input->post('s_name')),
            's_cat' => trim($this->input->post('s_cat')),
            's_code' => trim($this->input->post('s_code')),
            's_price' => trim($this->input->post('s_price'))
        );

        $insert = $this->sellModel->insertSell($data);
        echo json_encode(array("status" => TRUE));
	 }

	public function sellProductCodeExsits()
	{
	    $s_code=trim($this->input->post('s_code'));
	    $result=$this->categoryModel->tagExists($s_code);
	    if($result>0)
	    {
	     echo 1;
	     exit();  
	    }
	    echo json_encode(array("status" => TRUE)); 
	}

	public function sellItem()
	{
		$data = $this->sellModel->sellItem();
        
        $data_html = '';
        $i=0;
        $total_price = 0;

        $data_html .= '
              <table class="tblone">
                <tbody>
                  <tr>
                  <th width="5%">Sl</th>
                  <th width="25%">Name</th>
                  <th width="20%">Category</th>
                  <th width="15%">Code</th>
                  <th width="15%">Price(৳)</th>
                  <th width="10%">Action</th>
                </tr>
        ';
       
        foreach($data as $value) { 
          $total_price += $value->s_price;
          $i++;
          $data_html .= '
              <tr>
		          <td>' .$i. '</td>
		          <td><input type="text" name="sl_name" value="'.$value->s_name.'" readonly>

		             <input type="hidden" name="id" value="'.$value->id.'" readonly>
		          </td>

		          <td><input type="text" name="s_name" value="'.$value->cat_name.'" readonly>

              <input type="hidden" id="sl_cat" name="sl_cat" value="'.$value->s_cat.'" readonly>
		          </td>
		          <td><input type="text" name="sl_code" value="'.$value->s_code.'" readonly></td>

		          <td><input type="text" name="sl_price" value="'.$value->s_price.'" readonly></td>

                  <td><a style="cursor:pointer" onclick="deleteItem('.$value->id.')">X</a></td>
              </tr>
             ';             
        }

        $data_html .='
                    </tbody>
                   </table>
        ';

        $data_html .= '
              <div class="ctbale" style="float:right;text-align:left;background-color:#eee;padding: 5px; width:50%;">
	               <table height="120px">
	                  <tbody>
						<tr>
							<th>Sub Total</th>
							<td style="text-align:right"><b id="totalprice">'.$total_price.'</b> ৳</td>
						</tr>
						<tr>
							<th>Discount</th>
							<td><input class="discountinput" type="text" id="sl_discount" name="sl_discount"></td>
						</tr>
						<tr>
							<th>Grand Total</th>
							<td style="text-align:right">
							<b id="grandprice">'.$total_price.'</b> ৳
              <input type="hidden" id="sl_total" name="sl_total" value="'.$total_price.'" readonly>
							</td>
						</tr>
	                 </tbody>
	               </table>
               </div>
        ';

        echo json_encode($data_html);  
	}


	public function deleteItem($id)
	{
        $this->sellModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
	}

	 public function insertSaleItem(){

	 	  // $ids = $this->input->post('id');

	      //   $data = array(
	      //       'sl_name' => trim($this->input->post('sl_name')),
	      //       'sl_cat' => trim($this->input->post('sl_cat')),
	      //       'sl_code' => trim($this->input->post('sl_code')),
	      //       'sl_price' => trim($this->input->post('sl_price')),
	      //       'sl_discount' => trim($this->input->post('sl_discount')),

	      //       'sl_total ' => trim($this->input->post('sl_total '))
	      //   );
        
       //  $insert = $this->sellModel->insertSaleItem($data);
       //  echo json_encode(array("status" => TRUE));


           $data = $this->sellModel->sellItem();

           foreach($data as $value) {

	        $items = array(
              'c_id' => trim($this->input->post('c_id')),
	            'sl_name' => $value->s_name,
	            'sl_cat' => $value->s_cat,
	            'sl_code' => $value->s_code,
	            'sl_price' => $value->s_price,
	            'sl_token' => substr(md5(time()), 0, 5),
	            'sl_discount' => trim($this->input->post('sl_discount')),
	            'sl_total' => trim($this->input->post('sl_total'))
	        );

	        $insert = $this->sellModel->insertSaleItem($items);

           if($insert){
	        $data1 = array(
	            'sold' => '0'
	        );
	        $this->sellModel->update_sell($data1);
           }
	        echo json_encode(array("status" => TRUE));
         }
           
	 }


	 public function sellList()
	 {

      $breadcrumb_items = [
         'Home' => '/',
         'Sell List' => 'Sell/sellList'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Sell List | SMWA';

      $data['list'] = $this->sellModel->sellList();

      $this->load->view("admin/headers/header/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/sell/list",$data);
      $this->load->view("admin/footers/footer/footer");
	 }

	 public function sellDetail($token)
	 {
      $breadcrumb_items = [
         'Home' => '/',
         'Sell Detail' => 'Sell/sellDetail'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Sell Detail | SMWA';

      $customerData = $this->sellModel->sellDetail($token);

      foreach ($customerData as  $value) {
        $customerName = $value->c_name;
        $customerPhone = $value->c_phone;
        $customerAddress = $value->c_address;
      }
      $data['customerName'] = $customerName;
      $data['customerPhone'] = $customerPhone;
      $data['customerAddress'] = $customerAddress;

      $data['detail'] = $this->sellModel->sellDetail($token);
      $date = $this->sellModel->sellDetail($token);

      foreach ($date as $key => $value) {
        $d = $value->sl_datetime;
      }

      $data['date'] = $d;

      $this->load->view("admin/headers/header/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/sell/selldetail",$data);
      $this->load->view("admin/footers/footer/footer");
	 }
     
     public function sellDelete($token)
     {
       $result = $this->sellModel->delete_by_token($token);
        //$this->sellModel->delete_sellitems_token($token);
       echo json_encode(array("status" => TRUE));
       // if ($result) {
       //  $this->session->set_flashdata('msg', 'Data Deleted successfully');
       //    redirect('/sellList');
       // }
     }

     public function deleteEditeItem($id)
     {
      $this->sellModel->deleteEditeItem($id);
     }



  // function editSellItem($token){
      
  //     // Fetch specific product by ID
  //     $sellitems = $this->sellModel->editSellItem($token);

  //     foreach ($sellitems as $key => $value) {
  //       $id = $value->sl_id;
  //       $qty = $value->sl_qty;
  //       $price = $value->sl_price;
  //       $name = $value->sl_name;
  //     }
      
  //     // Add product to the cart
  //     $data = array(
  //         'id'    => $id,
  //         'qty'    => $qty,
  //         'price'    => $price,
  //         'name'    => $name
  //     );
      
  //     $this->cart->insert($data);
      
  //     // Redirect to the cart page
  //     echo $this->editSoldItem();
  // }



     public function editSellItem($token)
     {
      //$token = $this->uri->segment(3, 0);
      //$datetime = $this->uri->segment(4, 0);
      $breadcrumb_items = [
         'Home' => '/',
         'Sell' => 'Sell/sell',
         'Edit Sell' => 'Sell/diet'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['sellitems'] = $this->sellModel->editSellItem($token);
      //$data['sellitems'] = $this->cart->contents();

      $customerData = $this->sellModel->sellDetail($token);

      foreach ($customerData as  $value) {
        $customerName = $value->c_name;
        $customerId = $value->c_id;
      }
      $data['customerName'] = $customerName;
      $data['customerId'] = $customerId;


      $data['token'] = $token;
      //$data['datetime'] = $datetime;

      $data['headertitle'] = 'Edit Sell | SMWA';

      $this->load->view("admin/headers/header/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/sell/edit",$data);
      $this->load->view("admin/footers/selledit/footer");
     }


   public function fetch_selledit_item()
   {

     $sl_code=trim($this->input->post('sl_code'));
     $sl_token=trim($this->input->post('sl_token'));
     $result=$this->sellModel->codeExists($sl_code);
     $result_sell=$this->sellModel->codeExistsSell($sl_code, $sl_token);

     // if($result>0)
     // {
     //  echo '<p style="color: red;padding-bottom: 0px;font-size: 80%;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol""><i class="fa fa-info-circle" aria-hidden="true"></i>
     //      This product has already sold.</p>';
     //  exit();  
     //}else

     // if ($result_sell>0) {
     //  echo '<p class="text-info" style="padding-bottom: 0px;font-size: 80%;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol""><i class="fa fa-info-circle" aria-hidden="true"></i>
     //      You have already selected this product.</p>';
     //  exit();
     // }
    $output = '';
    $query = '';
    $this->load->model('productModel');
    if($this->input->post('sl_code'))
    {
     $query = $this->input->post('sl_code');
    }
    $data = $this->productModel->fetch_data($query);


    $output .= '

      <div id="card-custom" class="card card-outline card-success" style="position: absolute;z-index: 999; width: 100%">
       <div class="card-body">
            <form id="productItems">
      <table class="table borderless">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Code</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
          </tr>
        </thead>
        <tbody>';
        if($data->num_rows() > 0)
        {
         foreach($data->result() as $row)
         {
          $output .= '
            <tr>';
                  if($row->p_img){
                    $output .= '
             <td style="cursor: pointer;"><img class="img-responsive img-thumbnail" width="60" height="60" src="'.base_url($row->p_img).'"></td>';
              }else{
                    $output .= '
             <td style="cursor: pointer;"><img class="img-responsive img-thumbnail" width="60" height="60" src="'.base_url('webroot/dist/img/no-pic.png"').'"></td>';
              }
             $output .= '
             <td style="cursor: pointer;"><input type="text" name="sl_name" id="sl_name" value="'.$row->p_name.'" readonly></td>
             <td style="cursor: pointer;"><input type="text" id="c_name" value="'.$row->cat_name.'" readonly>

              <input type="hidden" id="sl_cat" name="sl_cat" value="'.$row->p_cat.'">
             </td>
             <td style="cursor: pointer;"><input type="text" name="s_code" value="'.$row->p_code.'" readonly>

             <input type="hidden" id="p_id" name="p_id" value="'.$row->p_id.'">
             </td>
             <input type="hidden" id="p_sub_cat" name="p_sub_cat" value="'.$row->p_sub_cat.'">
             </td>

             <td style="cursor: pointer;">
             <input type="number" name="quantity" id="quantity" value="1" style="border: 1px solid#ddd;text-align:center">
             </td>

             <td style="cursor: pointer;"><input type="text" name="sl_price" id="sl_price" value="'.$row->p_price.'" readonly></td>
            </tr>
            <tr>
            <td colspan="10">
              <button name="add_cart" p-name="'.$row->p_name.'" c-name="'.$row->cat_name.'" p-code="'.$row->p_code.'" p-price="'.$row->p_price.'" class="btn btn-block bg-gradient-info btn-flat add_cart">Add</button>
            </td>
            </tr>
          ';
         }
        }
        else
        {
         $output .= '<tr>
             <td colspan="10">No Data Found</td>
            </tr>';
        }
    $output .= '</tbody>
            </form>
       </div>
     </div>';

      echo $output;
   }

   public function insertEditSell()
   {
        $token = $this->input->post('token');
        $name = $this->input->post('name');
        $sl_cat = $this->input->post('sl_cat');
        $sl_code = $this->input->post('sl_code');
        $sl_price = $this->input->post('sl_price');
        $c_id = $this->input->post('c_id');
        $quantity = $this->input->post('quantity');
        $p_id = $this->input->post('p_id');

        $dataEdit = $this->sellModel->fetchEditSellItem($token);
        foreach ($dataEdit as $value) {
          $sl_discount = $value->sl_discount;
          $sl_total = $value->sl_total;
          $cart_comment = $value->cart_comment;
          $status = $value->status;
        }

        $Qntcheck = $this->sellModel->updateQnty($token,$quantity,$p_id);

        if ($Qntcheck>0) {

              $fetchQty = $this->sellModel->fetchQty($token,$quantity,$p_id);

              foreach ($fetchQty as $key => $value) {
                 $qty = $value->sl_qty;
              }

            if ($quantity == 1) {
                $data = array(
                    'sl_qty'=> $qty + 1
                );
                $updateQnt = $this->sellModel->updateQuantity($data,$p_id,$token);
                echo json_encode(array("status" => TRUE));
            }elseif($quantity>1){
                $data = array(
                    'sl_qty'=> $qty + $quantity
                );
                $updateQnt = $this->sellModel->updateQuantity($data,$p_id,$token);
                echo json_encode(array("status" => TRUE));
            }

        }else{
        $data = array(
            'sl_name'  => $name,
            'sl_cat'   => $sl_cat,
            'sl_code'  => $sl_code,
            'sl_price' => $sl_price,
            'sl_discount' => $sl_discount,
            'sl_total' => $sl_total,
            'c_id'     => $c_id,
            'sl_token'=> $token,
            'sl_qty'=> $quantity,
            'p_id'=> $p_id,
            'cart_comment'=> $cart_comment,
            'status'=> $status
        );

        $insert = $this->sellModel->insertEditSell($data,$token);
        echo json_encode(array("status" => TRUE));
        }



   }


	public function deleteEditItem($id)
	{
        $result = $this->sellModel->delete_item_by_id($id);
        echo json_encode(array("status" => TRUE));
	}

  public function insertEditSaleItem()
  {
        $token       = $this->input->post('sl_token');
        $sl_discount = $this->input->post('sl_discount');
        $sl_total    = $this->input->post('sl_total');
        $c_id        = $this->input->post('c_id');

        $dataEdit = $this->sellModel->fetchEditSellItem($token);
        foreach ($dataEdit as $value) {
        $data = array(
            'sl_discount'   => $sl_discount,
            'sl_total'      => $sl_total,
            'sl_token'      => $value->sl_token,
            'c_id'          => $c_id
        );
        }
        $insert = $this->sellModel->insertEditSaleItem($data,$token);
        echo json_encode(array("status" => TRUE));

  }

  public function customerList()
  {
      $searchTerm = $this->input->post('searchkey');
      $sl_token = $this->input->post('sl_token');

      $response = $this->sellModel->getCustomers($searchTerm);

      $datatable = '';
        if ($response->num_rows() > 0) {
        foreach ($response->result() as $value) {
            $datatable .= '
                <div class="d-flex flex-row" id="customerDt">
                <div class="p-2" id="customerName">'.$value->c_name.'</div>
                <div class="p-2"></div>

                <div class="p-2" id="customerMobile">'.$value->c_phone.'
                </div>
                 <input type="hidden" id="customerId" value="'.$value->c_id.'">
                </div>
               ';
        }
      }else{
            $datatable .= '
                <tr id="CustomerPage" onclick="customerPage()">
                   <td><a href="'.base_url('Customer/customer').'">Not Found(Click here to add customer)</a></td>
                </tr>
               ';
      }


      echo $datatable;
  }

  public function updateSlqty(){
      $token = $this->input->post('sl_token');
      //$sl_code = $this->input->post('sl_code');
      $sl_price = $this->input->post('sl_price');
      $sl_qty = $this->input->post('sl_qty');
      $p_id = $this->input->post('p_id');

      $fetchQty = $this->sellModel->fetchQty($token,$sl_qty,$p_id);

      foreach ($fetchQty as $key => $value) {
         $sl_price = $value->sl_price;
      }

      $total_price += $sl_price*$sl_qty;

      $data = array(
          'sl_qty'=> $sl_qty,
          'sl_total'=> $total_price
      );

      $fetchQty = $this->sellModel->updateSlqty($token,$sl_qty,$p_id,$data);

      echo json_encode(array("status" => TRUE));

  }

  public function undateComment(){
      $token = $this->input->post('sl_token');
      
      $comment = $this->input->post('comment');

      $data = array(
          'cart_comment'=> $comment
      );

      $fetchQty = $this->sellModel->undateComment($token,$comment,$data);
  }

  public function updateDiscount(){
      $token = $this->input->post('sl_token');
      $sl_discount = $this->input->post('sl_discount');
      
      $val = $this->input->post('val');

      $data = array(
          'sl_discount'=> $sl_discount,
          'sl_total'=> $val
      );

      $fetchQty = $this->sellModel->updateDiscount($token,$data);
  }

  public function updatePay(){
      $token = $this->input->post('sl_token');
      
      $pay_st = $this->input->post('pay_st');

      $data = array(
          'status '=> $pay_st
      );

      $fetchQty = $this->sellModel->updatePay($token,$data);
  }

  public function updateCustomer(){
      $token = $this->input->post('sl_token');
      
      $customerId = $this->input->post('customerId');

      $data = array(
          'c_id '=> $customerId
      );

      $fetchQty = $this->sellModel->updateCustomer($token,$data);  
    }


    public function list_sell(){
        $list = $this->sellModel->get_datatables();

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {
            $no++;
            $row = array();
            $row[] = date("j M Y h:i A", strtotime($value->sl_datetime));
            $row[] = $value->sl_discount;
            $row[] = $value->sl_total;

            //add html for action
            $row[] = '
                    <div class="dropdown">
                      <button class="btn btn-info btn-flat dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="'.base_url('Sell/sellDetail/'.$value->sl_token).'" style="cursor: pointer;" ><i class="fas fa-eye"></i> Detail</a>

                        <a class="dropdown-item"  href="'.base_url('Sell/editSellItem/'.$value->sl_token).'"><i class="fas fa-edit"></i> Edit</a>

                        <a onclick="delete_sell('."'".$value->sl_token."'".')" class="dropdown-item" href=""><i class="fas fa-trash"></i> Delete</a>
                      </div>
                    </div> 
            ';
            $data[] = $row;

        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sellModel->count_all(),
            "recordsFiltered" => $this->sellModel->count_filtered(),
            "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }
}   