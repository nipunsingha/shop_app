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
                           <div class="card">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12 col-lg-12">
                                   <form id="search" autocomplete="off">
                                    <label>Select Product By Code</label>
                                    <input type="hidden" name="sl_token" id="sl_token" value="<?php echo $token;?>">
                                     <div class="input-group">
                                        <input class="form-control py-2 border-right-0 border" type="text" id="sl_code" name="sl_code">
                                        <span class="input-group-append">
                                            <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                                        </span>
                                     </div>
                                     <div class="alert alert-info" style="display:none;"></div>
                                   </form>
                                   <div id="result" style="display: none;position: relative;"></div>
                                </div>
                              </div>
                            </div>
                           </div>
                        </div>
                      </div><!-- /.row -->
                      <div class="card card-primary">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-12 col-lg-12">
                              <form id="customerForm">
                                <label>Add Customer</label>              
                                <div class="input-group">
                                    <input type="hidden" id="c_id" name="c_id" value="<?php echo $customerId;?>">
                                    <input class="form-control py-2 rounded-left border" type="text" value="<?php echo $customerName;?>" id="searchkey">
                                    <span class="input-group-append">
                                        <div class="input-group-text bg-transparent"><i class="fas fa-user"></i></div>
                                    </span>
                                </div>
                                <div id="searchResult" style="display: none"></div>
                              </form> 
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12 col-sm-12 hero-feature">
                          <div id="data_table" class="table-responsive">
                            <form id="addSoldItem">
                              <table class="tblone">
                                <tbody>
                                  <tr>
                                  <th width="5%">Sl</th>
                                  <th width="25%">Name</th>
                                  <th width="20%">Category</th>
                                  <th width="15%">Code</th>
                                  <th width="15%">Quantity</th>
                                  <th width="15%">Price(৳)</th>
                                  <th width="10%">Action</th>
                                </tr>
                              
                              <?php
                               $i=0;
                               $total_price = 0;
                               if (!empty($sellitems)) {
                               foreach ($sellitems as $value) {
                               $i++;
                               $total_price += $value->sl_price;
                               $sl_token = $value->sl_token;
                               $sl_discount = $value->sl_discount;
                              ?>
                              <tr>
                              <td><?php echo $i;?></td>
                              <td><?php echo $value->sl_name;?></td>
                              <td><?php echo $value->cat_name;?></td>
                              <td><?php echo $value->sl_code;?></td>
                              <td><input type="number" name="sl_qty" value="<?php echo $value->sl_qty;?>"></td>
                              <td><?php echo $value->sl_price;?></td>
                              <td><a style="cursor:pointer" onclick="deleteItem(<?php echo $value->sl_id;?>)">X</a></td>
                              </tr>
                               <?php }?>
                               <?php }?>
                              
                            </tbody>
                           </table>
                              <div class="ctbale" style="float:right;text-align:left;background-color:#eee;padding: 5px; width:50%;">
                                 <table height="120px">
                                    <tbody>
                                      <tr>
                                        <th>Sub Total</th>
                                        <td style="text-align:right"><b id="totalprice"><?php echo $total_price;?></b> ৳</td>
                                      </tr>
                                      <tr>
                                        <th>Discount</th>
                                        <td><input class="discountinput" type="text" id="sl_discount" name="sl_discount" value="<?php echo $sl_discount;?>"></td>
                                      </tr>
                                      <tr>
                                        <th>Grand Total</th>
                                        <td style="text-align:right">
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
                            <div class="mt-3">
                              <button type="button" id="soldbtn" class="btn btn-block bg-gradient-info btn-flat">Update</button>
                            </div>
                       </div>
                    </div>
               </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      
    </div><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->