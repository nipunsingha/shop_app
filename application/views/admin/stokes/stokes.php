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
                <table id="usertable" class="table table-bordered table-hover" style="width: 100%">
                  <thead  style="text-align: center;">
                  <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sub cateogry</th>
                    <th>Code</th>
                    <th>Quantity</th>
                    <th>View</th>
                  </tr>
                  </thead>
                  <tbody style="text-align: center;">
                    <?php 
                       foreach ($stokeslist as $key => $value) {
                    ?>
                    <tr>
                      <td><?php echo $value->p_name;?></td>
                      <td><?php echo $value->cat_name;?></td>
                      <td><?php echo $value->sub_name;?></td>
                      <td><?php echo $value->p_code;?></td>
                      <td><?php echo $value->p_qty;?></td>
                      <td><a href="<?php echo base_url('Stokes/viewStokes/'.$value->sl_code)?>" class="btn btn-success">View Stokes</a></td>
                    </tr>
                    <?php }?>
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