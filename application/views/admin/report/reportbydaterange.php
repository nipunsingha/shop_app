  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Date range report</h1>
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
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <form action="<?php echo base_url();?>Report/reportByDateRangeWithValue" method="GET">
                      <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                           <label>Date</label>
                           <input type="text" class="form-control" name="f_date" id="f_date" required>
                        </div>
                      </div><!-- /.col-md-12 -->

                      <div class="col-md-6">
                        <div class="form-group">
                           <label>Date</label>
                           <input type="text" class="form-control" name="e_date" id="e_date" required>
                        </div>
                      </div><!-- /.col-md-12 -->
                      </div>
                      <div class="form-group">
                        <button class="btn btn-success" href="">View</button>
                      </div>
                    </form>
                </div>
              </div>
            </div><!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

