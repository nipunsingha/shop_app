  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Customer</h1>
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
                 <form action="<?php echo base_url('Customer/updateCustomerInfo/'.$customerdetail->c_id);?>" method="POST" id="customerEditForm">
                    <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" id="" name="c_name" value="<?php echo $customerdetail->c_name;?>">
                         </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Mobile</label>
                          <input class="form-control" type="text" id="" name="c_phone" value="<?php echo $customerdetail->c_phone;?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                       <label>Address</label>
                       <textarea class="form-control" name="c_address" rows="3"><?php echo $customerdetail->c_address?></textarea>
                    </div>
                    <div class="form-gruop">
                      <button class="btn btn-primary btn-flat">Edit</button>
                    </div>
                 </form>
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