  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Sell</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
             <?php // echo $breadcrumb_bootstrap_style;?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
               <div class="card card-primary card-outline">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-lg-12">
                       <form id="search" autocomplete="off">
                        <label>Search Product By Code</label>
                         <div class="input-group">
                            <input class="form-control py-2 border-right-0 border" type="text" id="s_code" name="s_code">
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
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url()?>webroot/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>webroot/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url()?>webroot/dist/js/active.js"></script>

<script>
  $(document).ready(function(){
   function load_data(s_code)
     {
        $s_code = $('#s_code').val();

        $.ajax({
         url:"<?php echo base_url(); ?>Sell/fetch",
         method:"POST",
         data:{s_code:s_code},
         success:function(data){
            if(data)
            {
           $('#result').html(data);
            }
         }
        })
     }

     $('#s_code').keyup(function(){
      var search = $(this).val();
      if(search != '')
      {
      $('#result').css({"display": "block"});
       load_data(search);
      }
      else{
        $('#result').css({"display": "none"});
      }

     });

  });  
</script>

</body>
</html>

