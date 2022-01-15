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

<!-- view modal -->
<div class="modal fade" id="modal_productview" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="text-muted fas fa-info-circle"></i> Product Detail </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                   <div class="col-md-12">
                      <div id="p_img"></div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <table class="table table-bordered">
                             <tbody>
                                  <tr>
                                    <div id="p_img"></div>
                                  </tr> 
                                  <tr>
                                    <th>Name</th>
                                    <td id="name"></td>
                                  </tr>
                                  <tr>
                                    <th>Category</th>
                                    <td id="p_cat"></td>
                                  </tr>
                                  <tr>
                                    <th>Sub Category</th>
                                    <td id="p_sub"></td>
                                  </tr>
                                  <tr>
                                    <th>Code</th>
                                    <td id="p_code"></td>
                                  </tr>
                                  <tr>
                                    <th>Price</th>
                                    <td id="p_price"></td>
                                  </tr>
                                  <tr>
                                    <th>Entry Date</th>
                                    <td id="p_date"></td>
                                  <tr>
                                    <th>Description</th>
                                    <td id="p_des"></td>
                                  </tr>
                             </tbody>
                        </table>
                   </div> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
<!-- Toastr -->
<script src="<?php echo base_url()?>webroot/plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>webroot/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url()?>webroot/dist/js/active.js"></script>
<!-- page script -->
<script>
function delete_confirm(){
 return confirm("Delete!");
}
  table = $('#productlist').DataTable({
      "processing": true,
      "serverSide": true, 
      "order": [],
      "ordering": false,
      "ajax": {
      "url": "<?php echo base_url('Product/list_product')?>",
      "type": "POST"
      },
      "columnDefs": [
      { 
      "targets": [ -1 ],
      "orderable": false,
      },
      ],
      oLanguage: {sProcessing: "<i class='fas fa-spinner fa-spin'></i>"
    }
    });


  function productview(id)
  {

  $('#modal_productview').modal('show');
  //$("#modal_productview").find(".modal-title").text('Product Detail');

      $.ajax({
          url : "<?php echo site_url('Product/viewproductbyid/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
             $("#p_img").html(data.p_img);
             $("#name").html(data.p_name);
             $("#p_cat").html(data.cat_name);
             $("#p_code").html(data.p_code);
             $("#p_sub").html(data.p_sub_cat);
             $("#p_price").html(data.p_price);
             $("#p_date").html(data.p_date);
             $("#p_des").html(data.p_des);

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

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


$('#p_date').datetimepicker({
    format: 'Y-M-D',
});

//Create User form validation
$("form#add_product").validate({
    rules: {
        p_name: {
            required: true,

        },

        p_cat: {
            required: true,

        },

        p_code: {
            required: true,
             remote: {
                url: "<?php echo base_url();?>Product/productCodeExsits",
                type: "post"
             }  
        },

        p_price: {
            required: true,

        },

        p_date: {
            required: true,

        },

        p_img:{
            required: false,
            extension: "jpg|jpeg|png",  
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
            remote:   "This code is already in use. Please try another one"
        },

        p_price: {
            required: "This field is required",
        },

        p_date: {
            required: "This field is required",
        },

        p_img: {
                extension: "Only JPG and PNG files are allowed."
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
</body>
</html>