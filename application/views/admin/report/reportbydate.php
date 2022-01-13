  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reports by date</h1>
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
            <?php if($this->session->flashdata('msg')){ ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('msg');?>
            </div>
            <?php } ?> 
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h3 class="text-center">Date: <?php echo $this->uri->segment(3, 0);?></h3>
                <table id="" class="table table-bordered table-striped" style="width: 100%">
                  <thead>
                  <tr>
                    <th width="10%">Date</th>
                    <th width="10%">Name</th>
                    <th width="10%">code</th>
                    <th width="10%">Price</th>
                    <th width="10%">Quantity</th>
                    <th width="10%">Subtotal</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $totall=0; 
                    $subtotall=0; 
                    $dis=0; 
                    foreach ($reportbydate as $key => $value) {
                    $totall +=  $value->sl_total;
                    ?>
                    <tr>
                      <td><?php echo date("j M Y h:i A", strtotime($value->sl_datetime));?></td>
                      <td><?php echo $value->sl_name;?></td>
                      <td><?php echo $value->sl_code;?></td>
                      <td><?php echo $value->sl_price;?></td>
                      <td><?php echo $value->sl_qty;?></td>
                      <td><?php echo $value->sl_total;?></td>
                    </tr>
                   <?php }?>
                   <tr>
                    <th colspan="5">Totall</th>
                    <td><?php echo $totall;?></td>
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

