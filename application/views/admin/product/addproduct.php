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
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-body">
                <form action="<?php echo base_url('Product/insertProduct');?>" id="add_product" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" name="p_name" id="p_name" placeholder="Product Name">
                    <?php echo form_error('p_name', '<div class="text-primary">', '</div>'); ?>
                  </div>
                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Category</label>
                            <select class="custom-select" id="p_cat" name="p_cat">
                              <option value="">Select</option>
                             <?php 
                                 foreach ($cats as $key => $cat) {
                             ?>
                             <option value="<?php echo $cat->id;?>"><?php echo $cat->cat_name;?></option>
                             <?php }?>
                            </select>
                            <?php echo form_error('p_cat', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Category</label>
                            <select name="p_sub_cat" id="sub_cat" class="form-control input-lg">
                            <option value="0">Select Subcategory</option>
                            </select>
                        </div>
                      </div>


                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Product Code</label>
                          <input type="text" class="form-control" name="p_code" id="p_code" placeholder="Product Code">
                          <?php echo form_error('p_code', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Price</label>
                          <input type="text" class="form-control" name="p_price" id="p_price" placeholder="Price">
                          <?php echo form_error('p_price', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Quantity</label>
                          <input type="text" class="form-control" name="p_qty" id="p_qty" placeholder="Quantity">
                          <?php echo form_error('p_qty', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Date</label>

                            <input type="text" class="form-control datetimepicker-input" name="p_date" id="p_date" data-toggle="datetimepicker" placeholder="yyyy-mm-dd" data-target="#p_date">

                            <?php echo form_error('p_date', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                      <input type="file" name="p_img" class="form-control">
                      <?php 
                          if (isset($error)) {
                            echo $error;
                          }
                      ?>
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="p_des" rows="3" placeholder="Description"></textarea>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-block bg-gradient-info btn-flat">Add</button>
                  </div>
        
                <!-- /.card-body -->
                </form>
                <!-- /form -->
              </div>
            </div><!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->