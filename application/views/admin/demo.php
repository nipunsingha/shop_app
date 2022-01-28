  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Product</h1>
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
                         <div class="card card-primary ">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12 col-lg-12">
                                 <form id="search" autocomplete="off">
                                  <label>Select Product By Code</label>
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
                    </div>
                    <div class="row">
                      <div class="col-lg-12 col-sm-12 hero-feature">
                            <form id="addSoldItem">
                               <div class="card card-primary">
                                 <div class="card-body">                           
                                  <!-- Select Element -->
                                   <select id="selUser" class="form-control" name="customerId" style="width: 100%">
                                   </select>
                                 </div>
                               </div>
                              <div id="data_html" class="table-responsive"></div>

                            <div class="row">
                               <div class="col-md-6">
                                 <div class="card card-primar " style="margin-top: 50px">
                                  <div class="card-body">
                                    <div class="form-group">
                                       <label>Payment Status</label><br>
                                       <select id="pay_st" class="form-control" name="status" style="width: 100%">
                                        <option value="">Select Status</option>
                                        <option value="paid">Paid</option>
                                        <option value="due">Due</option>      
                                       </select>
                                       <div class="text-danger" style="display: none;font-size: 80%;color: #dc3545;">
                                      </div>
                                    </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                           <div class="card card-primar " style="margin-top: 50px">
                            <div class="card-body">
                                <div class="form-group">
                                  <label>Note</label><br>
                                  <textarea class="form-control" id="cart_comment" name="cart_comment" rows="3" placeholder="Note"></textarea>           
                                </div>
                            </div>
                           </div>
                          </form>

                           <div class="mt-3">
                              <button type="button" id="soldbtn" class="btn bg-gradient-info btn-flat float-right">Add Sell</button>
                          </div>
                       </div>
                    </div>
                </div>
             </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

