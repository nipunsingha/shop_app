<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Edit Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <?php echo $breadcrumb_bootstrap_style;?>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header" style="border-bottom: none">
                  <h3 class="card-title"><span style="font-size: 30px;"><i class="fas fa-shopping-cart"></i></span></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="row cartst" style="margin-bottom: 25px;">
                              <div class="col-md-12 col-lg-12">
                                 <form id="search" autocomplete="off">
                                  <label>Select Product By Code</label>
                                   <div class="input-group">
                                      <input class="form-control py-2 border-right-0 border cartst" type="text" id="sl_code" name="sl_code" placeholder="Product code..">
                                      <span class="input-group-append">
                                          <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                                      </span>
                                   </div>
                                   <div class="alert alert-info" style="display:none;"></div>
                                 </form>
                                 <div id="result" style="display: none;position: relative;"></div>
                              </div>
                            </div>
   

                            <form id="addSoldItem">
                              <div class="row " style="margin-bottom: 25px;">
                                <div class="col-md-4 cartst">
              
                                <div class="form-group">
                                    <label>Customer</label><br>

                                    <input class="form-control border cartst" type="text" value="<?php echo $customerName;?>" id="searchkey" tokenId="<?php echo $token;?>">

                                    <input type="hidden" id="c_id" name="c_id" value="<?php echo $customerId;?>">
                                </div>
                                <div id="searchResult" style="display: none"></div>
                                </div>
                                <div class="col-md-4 cartst">
                                    <div class="form-group">
                                       <label>Payment Status</label><br>
                                       <select id="pay_st" class="form-control cartst" name="status" tokenId="<?php echo $sl_token;?>">
                                        
                                        <option <?php if ($status == 'paid') echo 'selected'; ?> value="paid">Paid</option>

                                        <option <?php if ($status == 'due') echo 'selected'; ?> value="due">Due</option>      
                                       </select>
                                       <div class="text-danger" style="display: none;font-size: 80%;color: #dc3545;">
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4 cartst">
                                  <div class="form-group ">
                                    <label>Note</label><br>
                                    <textarea class="form-control cartst" name="comment" rows="2" id="comment" tokenId="<?php echo $sl_token;?>"><?php echo $comment;?></textarea>           
                                  </div> 
                                </div>
                              </div>
                             <b class="cartst">Order Table *</b>
                              <div id="data_html" class="table-responsive">
                              <table class="table-hover cart-table">
                                <tbody>
                                <tr>
                                  <th width="5%;">Sl</th>
                                  <th width="15%;">Name</th>
                                  <th width="10%;">Category</th>
                                  <th width="15%;">Code</th>
                                  <th width="10%;">qty</th>
                                  <th width="10%;">Price(৳)</th>
                                  <th width="20%;">Action</th>
                                </tr>
                              
                              <?php
                               $i=0;
                               $total_price = 0;
                               if (!empty($sellitems)) {
                               foreach ($sellitems as $value) {
                               $i++;

                               $sl_qty = $value->sl_qty;
                               $sl_total = $value->sl_total;

                               $status = $value->status;
                               

                               $total_price += $value->sl_price*$sl_qty;
                               $sl_token = $value->sl_token;
                               $sl_discount = $value->sl_discount;
                              ?>
                              <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $value->sl_name;?></td>
                              <td><?php echo $value->cat_name;?></td>
                              <td><?php echo $value->sl_code;?></td>
                              <td>
                                <input type="number" id="sl_qty" name="sl_qty" value="<?php echo $value->sl_qty;?>" style="border: 1px solid #b9bfc1;text-align: center;"

                                 p_id="<?php echo $value->p_id;?>"

                                 sl_token="<?php echo $value->sl_token;?>"

                                 sl_price="<?php echo $value->sl_price;?>"
                                 
                                 sl_code="<?php echo $value->sl_code;?>"
                                >

                              </td>
                              <td><?php echo $value->sl_price;?></td>
                              <td><a style="cursor:pointer;color:white;" onclick="deleteItem(<?php echo $value->sl_id;?>)" class="btn bg-gradient-danger btn-xs">Delete</a></td>
                              </tr>
                              <?php }?>
                              <?php }?>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Sub Total</b></td>
                                <td><b id="totalprice"><?php
                                 echo $total_price;
                                 ?></b> ৳</td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Discount</b></td>
                                <td><input class="discountinput" type="text" id="sl_discount" tokenId="<?php echo $sl_token;?>"  totalId="<?php echo $sl_total;?>" 
                                subtotal="<?php echo $total_price;?>"
                                  name="sl_discount" value="<?php echo $sl_discount;?>" style="border-radius: 5px;border: 1px solid#33d7ff;padding: 3px; text-align:center!important;"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Grand Total</b></td>
                                <td>
                                <b id="grandprice"><?php if (!empty($sl_discount)) {
                                  echo $price =  $total_price-$sl_discount;
                                }else{
                                  echo $total_price;
                                }  
                                 ?></b> ৳

                                <input type="hidden" id="sl_total" name="sl_total" value="<?php echo $total_price;?>" readonly>

                                <input type="hidden" id="sl_token" name="sl_token" value="<?php echo $sl_token;?>" readonly>
                                </td>
                              </tr>
                              </tbody>
                              </table>
                              </div>
                            
                          </form>
                        </div>
                    </div><!-- /.row -->
                 </div>
             </div>
           </div>
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->