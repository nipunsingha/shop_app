  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
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
            <button class="btn bg-gradient-primary btn-flat mb-2" onclick="add_category()"><ion-icon name="heart"></ion-icon>
             Add Category</button>

             <button class="btn btn-info btn-flat mb-2" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reload</button>

            <div class="card card-primary card-outline">
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover" style="width: 100%">
                  <thead  style="text-align: center;">
                  <tr>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody  style="text-align: center;">
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