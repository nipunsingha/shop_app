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
  <script src = "<?php echo base_url()?>webroot/plugins/jquery-ui/jquery-ui.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url()?>webroot/plugins/toastr/toastr.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url()?>webroot/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- date-range-picker -->
<script src="<?php echo base_url()?>webroot/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>webroot/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()?>webroot/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url()?>webroot/dist/js/active.js"></script>

<script>

   $(document).ready(function(){

      $("#selUser").select2({
        theme: 'bootstrap4',
        placeholder: "Select Customer",
        allowClear: true,
        language: {
          noResults: function(searchedTerm) {
            return "<a href='<?= base_url() ?>Customer/customer' style='cursor: pointer;'>Not found(Click here to add customer)</a>";
          },
          searching: function() {
              return null;
          }

        },
        escapeMarkup: function(markup) {
          return markup;
        },
         ajax: { 
           url: '<?= base_url() ?>Cart/customerListSearch',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });

  $(document).ready(function(){
   function load_customer(searchkey)
     {
        var searchkey = $('#searchkey').val();
        $.ajax({
         url:"<?php echo base_url(); ?>Cart/customerList",
         method:"POST",
         data:{searchkey:searchkey},
         success:function(data){
            if(data)
            {
           $('#searchResult').html(data);
            }
         }
        })
     }

     $('#searchkey').keyup(function(){
      var search= $(this).val();
      if(search != '')
      {
      $('#searchResult').css({"display": "block"});
       load_customer(search);
      }
      else{
        $('#searchResult').css({"display": "none"});
        $('#c_id').val('');
      }

     });

  });
  
  $(document).on('click', '#customerDt', function(e){
    e.preventDefault();
    var customerName = $("#customerName").html();
    var customerMobile = $("#customerMobile").html();
    var customerId = $('#customerId').val();
    var grandprice = $("#searchkey").val(customerName);
    var c_id = $("#c_id").val(customerId);
    $('#searchResult').css({"display": "none"}); 
  });

  $(document).ready(function(){
   function load_data(sl_code)
     {
        $sl_code = $('#sl_code').val();

        $.ajax({
         url:"<?php echo base_url(); ?>Cart/fetch",
         method:"POST",
         data:{sl_code:sl_code},
         success:function(data){
            if(data)
            {
           $('#result').html(data);
            }
         }
        })
     }

     $('#sl_code').keyup(function(){
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




  $(document).on('click', '.add_cart', function(e){
    e.preventDefault();

    var name = $(this).attr('p-name');
    var c_name = $(this).attr('c-name');
    var code = $(this).attr('p-code');
    var price = $(this).attr('p-price');
    var p_id = $("#p_id").val();
    var s_cat = $('#s_cat').val();
    var sub_id = $('#sub_id').val();
    var qty = $('#quantity').val();
    var p_sub_cat = $('#p_sub_cat').val();

    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Cart/add_cart",  
    data: {name:name, c_name:c_name, code:code, price:price, s_cat:s_cat, qty:qty, sub_id:sub_id,p_id:p_id, p_sub_cat:p_sub_cat},    
    success: function(data){ 
       $('#card-custom').hide();
       $('form#productItems')[0].reset();
       $('#search')[0].reset();
       $('#data_html').html(data);

    }  
    }); 

  });



  $(document).on('keyup', '#sl_discount', function(e){
    e.preventDefault();
    var totalprice = $("#totalprice").html();
    var discount = $("#sl_discount").val();
    
    var finalprice = totalprice - discount;

    var grandprice = $("#grandprice").html(finalprice);
    $(".grandprice_hidden").val(finalprice);
      
  });

$(document).on('change', '[id^="qty"]', function(){
   var qty = $(this).val();
   var rowid = $(this).attr('id-data');
   $.ajax({
    url:"<?php echo base_url(); ?>Cart/cartItemUpdate",
    method:"POST",
    data:{rowid:rowid, qty:qty},
    success:function(data){
    $('#data_html').html(data);
    }
   });
  });

 $('#data_html').load("<?php echo base_url();?>Cart/load_cart");

 $(document).on('click', '.remove_inventory', function(){
  var row_id = $(this).attr("id");
  if(confirm("Are you sure you want to remove this?"))
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Cart/remove",
    method:"POST",
    data:{row_id:row_id},
    success:function(data)
    {
     $('#data_html').html(data);
    }
   });
  }
  else
  {
   return false;
  }
 });

  $(document).on('click', '#soldbtn', function(e){
    e.preventDefault();
    var data = $('#addSoldItem').serialize();
    var customerId = $("#selUser").val();
    var c_name = $("#c_name").val();
    var pay_st = $("#pay_st").val();
    var sl_price = $("#sl_price").val();

  

    if(c_name == undefined){
      Swal.fire({
        icon: 'error',
        title: 'Select Product.',
      })
    }else{

    if (pay_st == '') {
       $('.text-danger').html('<i class="fa fa-info-circle" aria-hidden="true"></i> Required</p>')
       .css({"font-weight": "normal","padding-bottom:":"0px"}).fadeIn();
    }else{
      $.ajax({  
      type: "POST",  
      url:  "<?php echo base_url();?>Cart/insertSaleItem",  
      data: data,    
      success: function(data){ 
        
         $('form#addSoldItem')[0].reset();

         toastr.options.onHidden = function() { window.location.href = "<?php echo base_url();?>Sell/sellList"; }

        toastr.success('Product successfully added to cart ', 'Success',{timeOut: 3000,progressBar: true});
      }  
      });
    }
     
  }


  });

    // $(document).ready(function(){
    //   //$( "#dates" ).datepicker();
    //   var date = $('#dates').datepicker({ dateFormat: 'yy-mm-dd' }).val();
    // } );


</script>

</body>
</html>