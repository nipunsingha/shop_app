<?php
/**
 * 
 */
class Sold extends CI_Controller
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
     // $result=$this->sellModel->codeExists($sl_code);
     // $result_sell=$this->sellModel->codeExistsSell($sl_code);
     // if($result>0)
     // {
     //  echo '<p style="color: red;padding-bottom: 0px;font-size: 80%;font-family:"Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol""><i class="fa fa-info-circle" aria-hidden="true"></i>
     //      This product has already sold.</p>';
     //  exit();  
     // }elseif ($result_sell>0) {
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
            <form id="editproductItems">
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
             <td style="cursor: pointer;"><input type="text" value="'.$row->cat_name.'" readonly>

             <input type="hidden" id="sl_cat" name="sl_cat" value="'.$row->p_cat.'">
             </td>
             <td style="cursor: pointer;"><input type="text" name="sl_code" id="sl_code" value="'.$row->p_code.'" readonly></td>
             <td><input type="number" name="sl_qty" value="'.$row->sl_qty.'"></td>
             <td style="cursor: pointer;"><input type="text" name="sl_price" id="sl_price" value="'.$row->p_price.'" readonly></td>
            </tr>
            <tr>
            <td colspan="10">
                <button  class="btn btn-block bg-gradient-info btn-flat edit_sold">Add</button>
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




	public function update_sell_cart()
	{
$token = $this->input->post('token');

$dataEdit = $this->sellModel->fetchEditSellItem($token);
foreach ($dataEdit as $value) {

        $id      = $value->sl_id;
        $qty     = $value->sl_qty;
        $price   = $value->sl_price;
        $name    = $value->sl_name;
        $c_name   = $value->sl_cat;
        $code  = $value->sl_code;
        $sl_discount = $value->sl_discount;
        $sl_total = $value->sl_total;
        $c_id     = $value->c_id;
        $sl_token = $value->sl_token;
}

        $data = array(
        'id'      => $id,
        'qty'     => $qty,
        'price'   => $price,
        'name'    => $name,
        'c_name'   => $c_name,
        'code'  => $code,
        'sl_discount' => $sl_discount,
        'sl_total' => $sl_total,
        'c_id'     => $c_id,
        'sl_token' => $sl_token
        );

  // $data = array(
  //  "name"       => $_POST["name"],
  //  "c_name"     => $_POST["c_name"],
  //  "id"         => $_POST["sub_id"],
  //  "code"       => $_POST["code"],

  //  "qty"        => $_POST["qty"],

  //  "s_cat"      => $_POST["s_cat"],
  //  "price"      => $_POST["price"]
  // );
   $this->cart->insert($data); //return rowid 
    echo $this->show_cart();
	 }


	public function show_cart()
	{
		//$items = $this->cart->contents();

        $token = $this->input->post('token');

        $dataEdit = $this->sellModel->fetchEditSellItem($token);
        
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
        foreach($dataEdit as $value) { 
          //$total_price += $value->s_price;
          $i++;
          $data_html .= '
              <tr>
                  <td>'.$i.'
                  <input type="hidden" id="id_rows" name="id_rows[]" value="'.$i.'">
                  </td>
		          <td><input type="text" name="sl_name[]" value="'.$value->sl_name.'" readonly>
		          </td>
		          <td><input type="text" id="c_name" name="c_name[]" value="'.$value->sl_cat.'" readonly>

              <input type="hidden" id="sl_cat_id" name="sl_cat_id[]">

              <input type="hidden" id="sub_id" name="sl_sub_id[]">

		          </td>
		          <td><input type="text" id="sl_code" name="sl_code[]" value="'.$value->sl_code.'" readonly>
		          </td>
		          <td><input type="number" id="qty'.$value->sl_id.'" name="qty[]" value="'.$value->sl_qty.'" style="border: 1px solid #ddd;">
		          </td>
		          <td><input type="text" name="sl_subtotal" value="'.$value->sl_total.'" readonly>

              <input type="hidden" id="sl_price" name="sl_price" value="'.$value->sl_price.'">
		          </td>

              <td><a style="cursor:pointer" class="remove_inventory">X</a></td>
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
          							<td style="text-align:right"><b id="totalprice"></b> ৳
                        <input type="hidden" name="sl_price_total">
                        </td>
          						</tr>
          						<tr>
          							<th>Discount</th>
          							<td><input class="discountinput" type="text" id="sl_discount" name="sl_discount"></td>
          						</tr>
          						<tr>
          							<th>Grand Total</th>
          							<td style="text-align:right">
          							<b id="grandprice"></b> ৳
                         <input type="hidden" id="sl_total" name="sl_total">
          							</td>
                      </tr>
	                 </tbody>
	               </table>
               </div>
        ';

        echo $data_html;  
	}



 } 