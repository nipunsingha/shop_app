  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sell Detail</h1>
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
            <div class="card card-info  card-outline">
              <div class="card-body">
                  <h2 class="mb-4"><i class="fas fa-info-circle"></i> Customer Info.</h2>
                  <div class="borderBtm"></div>

                  <?php if(!empty($customerName)){?>
                  <p><i class="fas fa-user-tie"></i> <?php echo $customerName;?></p>
                  <?php }elseif($customerName==0){?>
                  <p><i class="fas fa-user-tie"></i> Unknown</p>
                  <?php }?>

                  <?php if(!empty($customerPhone)){?>
                  <p><i class="fas fa-mobile"></i> <?php echo $customerPhone;?></p>
                  <?php }elseif($customerPhone==0){?>
                  <p><i class="fas fa-mobile"></i> Unknown</p>
                  <?php }?>

                  <?php if(!empty($customerAddress)){?>
                  <p><i class="fas fa-house-user"></i> <?php echo $customerAddress;?></p>
                  <?php }elseif($customerAddress==0){?>
                    <p><i class="fas fa-house-user"></i> Unknown</p>
                  <?php }?>
              </div>
            </div><!-- /.card -->
          </div><!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info  card-outline">
              <div class="card-body">
                <table id="" class="table table-borderless" style="width: 100%">
                  <thead>
                  <tr>
                    <th width="10%">Sl</th>
                    <th width="15%">Name</th>
                    <th width="10%">Code</th>
                    <th width="15%">Category</th>
                    <th width="15%">Subcategory</th>
                    <th width="10%">Qty</th>
                    <th width="10%">Price</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $i=0;
                  $total_price = 0;
                  ?>
                  <?php foreach ($detail as $value) { 
                    $i++;
                    $total_price += $value->p_price * $value->sl_qty;
                    $discount = $value->sl_discount;
                   ?>  
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $value->p_name;?></td>
                    <td><?php echo $value->p_code;?></td>
                    <td><?php echo $value->cat_name;?></td>
                    <td><?php
                       if ($value->sl_sub_cat=='0') {
                         echo "No subcategory";
                       }else{
                        echo $value->sub_name;
                       }
                    ?></td>
                    
                    <td><?php echo $value->sl_qty;?></td>
                    <td><?php echo $value->sl_price;?></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><?php echo $total_price;?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Discount</b></td>
                    <td><?php
                    if (!empty($discount)) {
                      echo $discount;
                    }else{
                      echo "-";
                    }
                    ?>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Grand Total</b></td>
                    <td><?php
                    if (!empty($discount)) {
                      echo $total_price - $discount;
                    }else{
                      echo $total_price;
                    }
                     
                    ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Payment:</b><br>
                      <?php echo $value->status;?></td>
 
                  </tr>
                  <tr>
                     <td><b>Date:<br></b>
                        <?php 
                     echo date("j M Y, h:i A", strtotime($value->sl_datetime));
                    ?></td>                 
                  </tr>
                  </tbody>
                </table>
              </div>
            </div><!-- /.card -->
          </div><!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

