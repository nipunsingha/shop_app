<?php
/**
 * 
 */
class Cart extends CI_Controller
{
	
   public function __construct() 
   {
      parent::__construct();
      if (! $this->session->userdata('username'))
      {
          redirect('Login/index'); // the user is not logged in, redirect them!
      }

      $this->load->library('cart');
      $this->load->library('breadcrumb');
      $this->load->model('productModel');
      $this->load->model('sellModel');
   }

   public function cart(){
      $breadcrumb_items = [
         'Home' => '/',
         'Add Cart' => 'Sell/sell'
      ];

      $template = [
         'tag_open' => '<ol class="breadcrumb float-sm-right">',
         'crumb_open' => '<li class="breadcrumb-item">',
         'crumb_active' => '<li class="breadcrumb-item active">'
      ];

      $this->breadcrumb->set_template($template);
      $this->breadcrumb->add_item($breadcrumb_items);
      $data['breadcrumb_bootstrap_style'] = $this->breadcrumb->generate();

      $data['headertitle'] = 'Add Cart | SMWA';

      $this->load->view("admin/headers/header/header",$data);
      $this->load->view("admin/sidebar");
      $this->load->view("admin/cart");
      $this->load->view("admin/footers/cart/footer");
   }

   public function fetch()
   {

     $this->load->library('cart');

     $sl_code=trim($this->input->post('sl_code'));
     // $result=$this->sellModel->codeExists($sl_code);
     // $result_sell=$this->sellModel->codeExistsSell($sl_code);
     // if($result>0)
     // {
     //  echo '<p style="color: red;padding-bottom: 0px;font-size: 80%;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol""><i class="fa fa-info-circle" aria-hidden="true"></i>
     //      This product has already sold.</p>';
     //  exit();  
     // }else
     
    // if ($result_sell>0) {
    //   echo '<p class="text-info" style="padding-bottom: 0px;font-size: 80%;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol""><i class="fa fa-info-circle" aria-hidden="true"></i>
    //       You have already selected this product.</p>';
    //   exit();
    //  }

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
			       <td style="cursor: pointer;"><input type="text" name="s_name" id="s_name" value="'.$row->p_name.'" readonly></td>
			       <td style="cursor: pointer;"><input type="text" id="c_name" value="'.$row->cat_name.'" readonly>

              <input type="hidden" id="s_cat" name="s_cat" value="'.$row->p_cat.'">
			       </td>
			       <td style="cursor: pointer;"><input type="text" name="s_code" value="'.$row->p_code.'" readonly>

             <input type="hidden" id="p_id" name="p_id" value="'.$row->p_id.'">
             </td>
             <input type="hidden" id="p_sub_cat" name="p_sub_cat" value="'.$row->p_sub_cat.'">
             </td>

			       <td style="cursor: pointer;"><input type="number" name="quantity" id="quantity" value="1" style="border: 1px solid#ddd;text-align:center"></td>
			       <td style="cursor: pointer;"><input type="text" name="s_price" value="'.$row->p_price.'" readonly></td>
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


	public function add_cart()
	{
  $data = array(
   "id"         => $_POST["p_id"],
   "qty"        => $_POST["qty"],
   "price"      => $_POST["price"],
   "name"       => $_POST["name"],
   "code"       => $_POST["code"],
   "c_name"     => $_POST["c_name"],
   "s_cat"      => $_POST["s_cat"],
   "p_sub_cat"  => $_POST["p_sub_cat"]
   
  );
   $this->cart->insert($data); //return rowid 
    echo $this->show_cart();
	 }


	public function show_cart()
	{
		$items = $this->cart->contents();
        
        $data_html = '';
        
        $i=0;

        $data_html .= '
              <table class="table table-bordered table-striped">
                <tbody>
                  <tr>
                  <th width="5%">Sl</th>
                  <th width="25%">Name</th>
                  <th width="20%">Category</th>
                  <th width="15%">Code</th>
                  <th width="15%">qty</th>
                  <th width="15%">Price(৳)</th>
                  <th width="10%">Action</th>
                </tr>
        ';
        foreach($items as $value) { 
          //$total_price += $value->s_price;
          $i++;
          $data_html .= '
              <tr>
                  <td>'.$i.'
                  <input type="hidden" id="id_rows" name="id_rows[]" value="'.$i.'">
                  </td>
		          <td><input type="text" name="sl_name[]" value="'.$value['name'].'" readonly>
		          </td>
		          <td><input type="text" id="c_name" name="c_name[]" value="'.$value['c_name'].'" readonly>

              <input type="hidden" id="sl_cat " name="sl_cat[]" value="'.$value['s_cat'].'">

              <input type="hidden" id="sl_sub_cat" name="sl_sub_cat[]" value="'.$value['p_sub_cat'].'">

		          </td>
		          <td><input type="text" id="sl_code" name="sl_code[]" value="'.$value['code'].'" readonly>
		          </td>
		          <td><input type="number" id="qty'.$value['id'].'" name="qty[]" value="'.$value['qty'].'" id-data="'.$value['rowid'].'" style="border: 1px solid #ddd;">
                 <input type="hidden" id="pro_id" name="p_id[]" value="'.$value['id'].'">
		          </td>
		          <td><input type="text" name="sl_subtotal" value="'.$value['subtotal'].'" readonly>

              <input type="hidden" id="sl_price" name="sl_price[]" value="'.$value['price'].'">
		          </td>

              <td><a style="cursor:pointer" class="remove_inventory" id="'.$value["rowid"].'">X</a></td>
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
          							<td style="text-align:right"><b id="totalprice">'.$this->cart->total().'</b> ৳
                        <input type="hidden" name="sl_price_total" value="'.$this->cart->total().'">
                        </td>
          						</tr>
          						<tr>
          							<th>Discount</th>
          							<td><input class="discountinput" type="text" id="sl_discount" name="sl_discount"></td>
          						</tr>
          						<tr>
          							<th>Grand Total</th>
          							<td style="text-align:right">
          							<b id="grandprice">'.$this->cart->total().'</b> ৳
                         <input type="hidden" id="sl_total" name="sl_total" class="grandprice_hidden" value="'.$this->cart->total().'">
          							</td>
                      </tr>
	                 </tbody>
	               </table>
               </div>
        ';

        echo $data_html;  
	}

	public function load_cart(){ 
	echo $this->show_cart();
   }


	public function cartItemUpdate(){
    $update=0;
    $rowid = $_POST['rowid'];
    //$price = $_POST['product_price'];

    $qty = $_POST['qty'];

	if (!empty($rowid) && !empty($qty)) {
	    $data = array(
	        'rowid' => $rowid,
	        'qty' => $qty        
	        );
	    $update = $this->cart->update($data);
	   }
     
    //echo $update?'ok':'err';
	  echo $this->show_cart();

	}

 function remove(){
  $row_id = $_POST["row_id"];
  $data = array(
   'rowid'  => $row_id,
   'qty'  => 0
  );
  $this->cart->update($data);
  echo $this->show_cart();;
 }


 public function clear()
 {
  $this->cart->destroy();
  echo $this->show_cart();
 }
   public function insertSaleItem(){

      $ids = $this->input->post('id_rows'); 

              $c_id = trim($this->input->post('c_id'));
              $sl_name = $this->input->post('sl_name');
              $sl_cat = $this->input->post('sl_cat');
              $sl_code = $this->input->post('sl_code');
              $sl_price = $this->input->post('sl_price');
              $sl_sub_id = $this->input->post('sl_sub_cat');

              $c_id = $this->input->post('customerId');

              $sl_qty = $this->input->post('qty');

              $sl_discount = $this->input->post('sl_discount');
              $sl_total = $this->input->post('sl_total');
              $sl_token = substr(md5(time()), 0, 5);
              $status = trim($this->input->post('status'));
              $cart_comment = trim($this->input->post('cart_comment'));
              $p_id = $this->input->post('p_id');
              
              $date = date("Y-m-d");


        $data = array();
        for ($i = 0; $i < count($this->input->post('id_rows')); $i++)
        {
            $data[$i] = array(
                'c_id'       => $c_id[$i],
                'sl_name'    => $sl_name[$i],
                'sl_cat'     => $sl_cat[$i],
                'sl_code'    => $sl_code[$i],
                'sl_price'   => $sl_price[$i],
                'sl_sub_cat' => $sl_sub_id[$i],
                'sl_qty'     => $sl_qty[$i],
                'sl_discount' => $sl_discount,
                'sl_total'   => $sl_total,
                'sl_token'   => $sl_token,
                'sl_date'   => $date,
                'status'     => $status,
                'cart_comment' => $cart_comment,
                'p_id' => $p_id[$i]
            );
             
        }
          // $data = array(
          //     'sl_name' => trim($this->input->post('sl_name')),
          //     'sl_cat' => trim($this->input->post('sl_cat_id')),
          //     'sl_sub_id ' => trim($this->input->post('sl_sub_id')),
          //     'sl_code' => trim($this->input->post('sl_code')),
          //     'sl_qty' => trim($this->input->post('qty')),
          //     'sl_price' => trim($this->input->post('sl_price')),
          //     'sl_discount' => trim($this->input->post('sl_discount')),
          //     'sl_total' => trim($this->input->post('sl_total')),
          //     'sl_token' => substr(md5(time()), 0, 5),
          //     'status' => trim($this->input->post('status')),
          //     'cart_comment' => trim($this->input->post('cart_comment'))
          // );
        
        $insert = $this->sellModel->insertSaleItem($data);
        if ($insert) {
          echo $this->clear();
        }
        echo json_encode(array("status" => TRUE));
           
   }

public function customerListSearch(){
      // Search term
      $searchTerm = $this->input->post('searchTerm');

      // Get users
      $response = $this->sellModel->customerListSearch($searchTerm);

      echo json_encode($response);
}

}