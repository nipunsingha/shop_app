  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add user</h1>
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
            <div class="card">
              <div class="card-body">
                <form class="cmxform" id="userform" action="<?php echo base_url();?>/User/ajax_add" method="post">
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="name">Full name</label>
                                 <input type="text" id="name" name="name" class="form-control" />
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="username">Username</label>
                                 <input type="text" id="username" name="username" class="form-control" />
                             </div>
                         </div>                        
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="level">User Role</label>
                                 <select name="level" id="level" class="form-control">
                                       <option value="">Select</option>
                                       <option value="admin">Admin</option>
                                       <option value="editor">Editor</option>
                                 </select>
                             </div>                             
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label for="password">Password</label>
                                 <input type="password" name="password" class="form-control" id="password" />
                             </div>                             
                         </div>
                     </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-success">Submit</button>
                     </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

