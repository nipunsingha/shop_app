
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Product List</h1>
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
            <?php if($this->session->flashdata('msg')){ ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('msg');?>
            </div>
            <?php } ?>            
            <div class="card">
              <div class="card-body">
                <table id="productlist" class="table table-borderless table-striped" style="width: 100%">
                  <thead>
                  <tr>
                    <th width="5%">SL</th>
                    <th width="10%">Image</th>
                    <th width="25%">Name</th>
                    <th width="10%">Category</th>
                    <th width="10%">Code</th>
                    <th width="10%">Price</th>
                    <th width="30%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=0;?>  
                  <?php foreach ($productlist as $list){ $i++?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <?php if(!empty($list->p_img)){?>
                    <td><img src="<?php echo base_url();?><?php echo $list->p_img;?>" class="img-responsive img-thumbnail" ></td>
                    <?php }else{?>
                    <td><img src="<?php echo base_url();?>webroot/dist/img/no-pic.png" class="img-responsive img-thumbnail"></td>
                    <?php }?>
                    <td><?php echo $list->p_name;?></td>
                    <td><?php echo $list->cat_name;?></td>
                    <td><?php echo $list->p_code;?></td>
                    <td><?php echo $list->p_price;?></td>
                    <td>
                    <div class="dropdown">
                      <button class="btn btn-info btn-flat dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" style="cursor: pointer;" onClick='productview(<?php echo $list->id;?>)' id="view"><i class="fas fa-eye"></i> Detail</a>

                        <a class="dropdown-item" href="<?php echo base_url('Product/productedit/'.$list->id)?>"><i class="fas fa-edit"></i> Edit</a>

                        <a onclick="return confirm('Delete?')" class="dropdown-item" href="<?php echo base_url('Product/productdelete/'.$list->id)?>"><i class="fas fa-trash"></i> Delete</a>
                      </div>
                    </div>                    
                    </td>
                  </tr>
                  <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->