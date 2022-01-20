  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stokes</h1>
          </div>
          <div class="col-sm-6">
            <?php echo $breadcrumb_bootstrap_style;?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <table id="viewQty" class="table table-bordered table-hover" style="width: 100%">
                  <thead  style="text-align: center;">
                  <tr>
                    <th>Name</th>
                    <th>Cat.</th>
                    <th>Sub cat.</th>
                    <th>Code</th>
                    <th>Total qty.</th>
                    <th>Sell qty.</th>
                    <th>Remain qty.</th>
                  </tr>
                  </thead>
                  <tbody style="text-align: center;">
                    <?php 
                      $total=0; 
                      $remain=0; 
                       foreach ($viewStokes as $key => $value) {
                    if (is_numeric($value->sl_qty)) {
                      $total += $value->sl_qty;

                      $p_name = $value->p_name;
                      $p_code = $value->p_code;
                      $cat_name = $value->cat_name;
                      $sub_name = $value->sub_name;
                      $p_qty = $value->p_qty;
                      $remain = $p_qty-$total;
                    }

                    ?>
                    <?php }?>
                    <tr>
                      <td><?php echo $p_name;?></td>
                      <td><?php echo $cat_name;?></td>
                      <td><?php echo $sub_name;?></td>
                      <td><?php echo $p_code;?></td>
                      <td><?php echo $p_qty;?></td>
                      <td><?php echo $total;?></td>
                      <td><?php echo $remain;?></td>
                    </tr>  
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->