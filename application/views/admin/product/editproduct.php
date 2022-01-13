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
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-body">
                <form action="<?php echo base_url('Product/productUpdate/'.$item->p_id);?>" id="edit_product" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" name="p_name" id="p_name" value="<?php echo $item->p_name;?>">
                    <?php echo form_error('p_name', '<div class="text-primary">', '</div>'); ?>
                  </div>
                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Category</label>
                            <select class="custom-select" id="p_cat" name="p_cat">
                             <option value="">Select Category</option>
                             <?php 
                                 foreach ($cats as $key => $cat) {
                             ?>
                             <option <?php if($item->p_cat == $cat->id){ echo 'selected="selected"'; } ?> value="<?php echo $cat->id ?>">
                              <?php echo $cat->cat_name;?>
                              </option>
                             <?php }?>
                            </select>
                            <?php echo form_error('p_cat', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Select subcategory</label>
                            <select name="p_sub_cat" id="sub_cat" class="custom-select">
                            <?php if($item->p_sub_cat == "0"){?>  
                            <option value="0">No Subcategory</option>
                            <?php } else {?>
                            <option value="0">Select Subcategory</option>
                            <?php }?>  
                            <?php 
                              foreach ($subcat as $value) {
                            ?>
                            <option <?php if($item->p_sub_cat == $value->sub_id){ echo 'selected="selected"'; } ?> value="<?php echo $value->sub_name ?>">
                              <?php echo $value->sub_name;?>

                              </option>
                            <?php }?>
                            </select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Product Code</label>
                          <input type="text" class="form-control" name="p_code" id="p_code" value="<?php echo $item->p_code;?>">
                          <?php echo form_error('p_code', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Price</label>
                          <input type="text" class="form-control" name="p_price" id="p_price" value="<?php echo $item->p_price;?>">
                          <?php echo form_error('p_price', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Date</label>

                            <input type="text" class="form-control datetimepicker-input" name="p_date" id="p_date" data-toggle="datetimepicker" data-target="#p_date">

                            <?php echo form_error('p_date', '<div class="text-primary">', '</div>'); ?>
                        </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label>Image</label>
                      <div></div>
                      <?php if($item->p_img){?>
                      <img src="<?php echo base_url($item->p_img);?>" width="150" height="150" class="img-responsive img-thumbnail" >
                      <?php }else{?>
                      <img src="<?php echo base_url('webroot/dist/img/no-pic.png');?>" width="150" height="150" class="img-responsive img-thumbnail" >
                      <?php }?>  
                  </div>
                  <div class="form-group">
                      <input type="file" name="p_img" class="form-control">
                      <?php 
                          if (isset($error)) {
                            echo $error;
                          }
                      ?>
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="p_des" rows="3"><?php echo $item->p_des;?></textarea>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-block bg-gradient-info btn-flat">Edit</button>
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