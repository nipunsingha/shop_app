
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Customer List</h1>
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
                <?php echo $this->session->flashdata('message');?>
            </div>
            <?php } ?>            
            <div class="card">
              <div class="card-body">
                <table id="customerlist" class="table table-borderless table-striped" style="width: 100%">
                  <thead>
                  <tr>
                    <th width="5%">SL</th>
                    <th width="25%">Name</th>
                    <th width="20%">Mobile</th>
                    <th width="25%">Address</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=0;?>  
                  <?php foreach ($customerlist as $list){ $i++?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $list->c_name;?></td>
                    <td><?php echo $list->c_phone;?></td>
                    <td><?php echo $list->c_address;?></td>
                    <td>
                    <div class="dropdown">
                      <button class="btn btn-info btn-flat dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="<?php echo base_url('Customer/customerEdit/'.$list->c_id)?>"><i class="fas fa-edit"></i> Edit</a>

                        <a onclick="return confirm('Delete?')" class="dropdown-item" href="<?php echo base_url('Customer/customerDelete/'.$list->c_id)?>"><i class="fas fa-trash"></i> Delete</a>
                      </div>
                    </div>                    
                    </td>
                  </tr>
                  <?php }?>
                  </tbody>
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