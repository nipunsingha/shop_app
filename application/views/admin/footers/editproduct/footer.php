  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
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
<!-- InputMask -->
<script src="<?php echo base_url()?>webroot/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url()?>webroot/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url()?>webroot/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url()?>webroot/dist/js/active.js"></script>
<!-- page script -->
<script>

$(document).ready(function(){
 $('#p_cat').change(function(){
  var sub_id = $('#p_cat').val();
  if(sub_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Product/fetch_subcat",
    method:"POST",
    data:{sub_id:sub_id},
    success:function(data)
    {
     $('#sub_cat').html(data);
    }
   });
  }
  else
  {
   $('#sub_cat').html('<option value="">Select Subcategory</option>');
  }
 });

 });


//edit date 
$('#p_date').datetimepicker({
    format: 'Y-M-D',
});

$("#p_date").val('<?php echo $item->p_date;?>');

//product edit

$("form#edit_product").validate({
    rules: {
        p_name: {
            required: true,

        },


        p_cat: {
            required: true,

        },

        p_code: {
            required: true, 
        },

        p_price: {
            required: true,

        },

        p_date: {
            required: true,

        },

        p_img:{
            required: false,
            extension: "jpg|jpeg|png"   
        }

                                 
    },
    messages: {
        p_name: {
            required: "This field is required",

        },

        p_cat: {
            required: "This field is required",
        },

        p_code: {
            required: "This field is required",
        },

        p_price: {
            required: "This field is required",
        },

        p_date: {
            required: "This field is required",
        },
        p_img: {
                extension: "Only JPG and PNG  files are allowed."
        },
                                   
    }
});
</script>
</body>
</html>