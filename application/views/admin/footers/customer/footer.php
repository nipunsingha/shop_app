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
<!-- jquery-validation -->
<script src="<?php echo base_url()?>webroot/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>webroot/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url()?>webroot/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url()?>webroot/dist/js/active.js"></script>
<script type="text/javascript">
    $('#customerlist').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
    });

  $('#customerForm').validate({
    rules: {
      c_name: {
        required: true,
      },
      c_phone: {
        required: true,
        remote: {
          url: "<?php echo base_url();?>Customer/customerMobileExsits",
          type: "post"
        } 
      }
    },
    messages: {
      c_name: {
        required: "This field is required",
      },
      c_phone: {
        required: "This field is required",
        remote:   "Phone number already exists"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#customerEditForm').validate({
    rules: {
      c_name: {
        required: true,
      },
      c_phone: {
        required: true,
      }
    },
    messages: {
      c_name: {
        required: "This field is required",
      },
      c_phone: {
        required: "This field is required",
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
</script>

<script type="text/javascript">



    var type = "<?php echo $this->session->flashdata('alert-type');?>";
    switch(type){
        case 'info':
            toastr.info("<?php echo $this->session->flashdata('message');?>");
            break;

        case 'warning':
            toastr.warning("<?php echo $this->session->flashdata('message');?>");
            break;

        case 'success':
            toastr.success("<?php echo $this->session->flashdata('message');?>");
            break;

        case 'error':
            toastr.error("<?php echo $this->session->flashdata('message');?>");
            break;
    }



</script>
</body>
</html>