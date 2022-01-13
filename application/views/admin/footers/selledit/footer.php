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

<!-- Toastr -->
<script src="<?php echo base_url()?>webroot/plugins/toastr/toastr.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>webroot/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url()?>webroot/dist/js/active.js"></script>

<script>
  $(document).ready(function(){
   function load_customer(searchkey)
     {
        var searchkey = $('#searchkey').val();
        var sl_token = $('#searchkey').attr('tokenId');
        $.ajax({
         url:"<?php echo base_url(); ?>Sell/customerList",
         method:"POST",
         data:{searchkey:searchkey,sl_token:sl_token},
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
      else
      {
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
    var sl_token = $('#sl_token').val();
    
    var grandprice = $("#searchkey").val(customerName);
    var c_id = $("#c_id").val(customerId);
    $('#searchResult').css({"display": "none"}); 


    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/updateCustomer",  
    data: {customerId:customerId,sl_token:sl_token},    
    success: function(data){ 

    }  
    });

  });


  $(document).ready(function(){
   function load_data(sl_code){
        var sl_code = $('#sl_code').val();
        var sl_token = $('#sl_token').val();
        $.ajax({
         url:"<?php echo base_url(); ?>Sell/fetch_selledit_item",
         method:"POST",
         data:{sl_code:sl_code, sl_token:sl_token},
         success:function(data){
            if(data){
           $('#result').html(data);
            }
          }
        })
     }

     $('#sl_code').keyup(function(){
      var search = $(this).val();
      if(search != ''){
      $('#result').css({"display": "block"});
       load_data(search);
      }else{
        $('#result').css({"display": "none"});
      }
     });
  });

  $(document).on('submit', '#productItems', function(e){
    e.preventDefault();
    //var data = $('#editproductItems').serialize();
     var token    = $("#sl_token").val();
     var name     = $("#sl_name").val();
     var sl_cat   = $("#sl_cat").val();
     var sl_code  = $("#sl_code").val();
     var sl_price = $("#sl_price").val();
     var quantity = $("#quantity").val();
     var p_id     = $("#p_id").val();
     var c_id     = $("#c_id").val();

    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/insertEditSell",  
    data: {name:name, sl_cat:sl_cat, sl_code:sl_code,sl_price:sl_price,token:token,c_id:c_id,quantity:quantity,p_id:p_id},    
    success: function(data){ 
        location.reload();
       $('#card-custom').hide();
       $('form#editproductItems')[0].reset();
       $('#search')[0].reset();
      }  
    });  
  });

  function deleteItem(id){
    if(confirm('Are you sure delete this Item?')){
      $.ajax({
          url : "<?php echo site_url('Sell/deleteEditItem')?>/"+id,
          type: "POST",
          dataType: "JSON",
          success: function(data){
              location.reload();
          },
          error: function (jqXHR, textStatus, errorThrown){
              alert('Error deleting data');
          }
      });
    }
  }

  $(document).on('keyup', '#sl_discount', function(e){
    e.preventDefault();
    var totalprice = $("#totalprice").html();
    var discount   = $("#sl_discount").val();
    var finalprice = totalprice - discount;
    var grandprice = $("#grandprice").html(finalprice);
  });

  $(document).on('click', '#soldbtn', function(e){
    e.preventDefault();
    var data        = $('#addSoldItem').serialize();
    var sl_discount = $("#sl_discount").val();
    var sl_total    = $("#sl_total").val();
    var sl_token    = $("#sl_token").val();
    var c_id        = $("#c_id").val();

    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/insertEditSaleItem",  
    data: {sl_discount:sl_discount,sl_total:sl_total,sl_token:sl_token,c_id:c_id},    
    success: function(data){ 
      //toastr.options.onHidden = function() { window.location.href = "<?php// echo base_url();?>Sell/sellList"; }
      toastr.success('Edited Successfully', 'Success',{timeOut: 3000,progressBar: true});
    }  
    });  
  });

  $(document).on('click', '#sl_qty', function(e){
    e.preventDefault();

    //var sl_qty = $("#sl_qty").val();
    var sl_qty = $(this).val();
    var sl_token = $(this).attr('sl_token');
    var sl_code = $(this).attr('sl_code');
    var sl_price = $(this).attr('sl_price');
    var p_id = $(this).attr('p_id');


    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/updateSlqty",  
    data: {sl_qty:sl_qty,sl_token:sl_token,sl_price:sl_price,p_id:p_id},    
    success: function(data){ 
      //toastr.options.onHidden = function() { window.location.href = "<?php// echo base_url();?>Sell/sellList"; }
      //toastr.success('Edited Successfully', 'Success',{timeOut: 3000,progressBar: true});
      location.reload();
    }  
    });  
  });


  $(document).on('keyup', '#comment', function(e){
    e.preventDefault();
     var comment = $("#comment").val();
     var sl_token = $(this).attr('tokenId');
    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/undateComment",  
    data: {sl_token:sl_token,comment:comment},    
    success: function(data){ 
      //toastr.options.onHidden = function() { window.location.href = "<?php// echo base_url();?>Sell/sellList"; }
    }  
    });
  });



  $(document).on('keyup', '#sl_discount', function(e){
    e.preventDefault();
     var sl_discount = $("#sl_discount").val();
     var sl_token = $(this).attr('tokenId');
     
    if(sl_discount=='') {
      var val = $(this).attr('subtotal');
    }
    else{
     var subtotal = $(this).attr('subtotal');
     var val = subtotal - sl_discount;  
 
    }

    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/updateDiscount",  
    data: {sl_token:sl_token,sl_discount:sl_discount,val:val},    
    success: function(data){ 

    }  
    });
  });


  $(document).on('click', '#pay_st', function(e){
    e.preventDefault();

    //var sl_qty = $("#sl_qty").val();
    var pay_st = $(this).val();
    var sl_token = $(this).attr('tokenId');

    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/updatePay",  
    data: {pay_st:pay_st,sl_token:sl_token},    
    success: function(data){ 
      //toastr.options.onHidden = function() { window.location.href = "<?php// echo base_url();?>Sell/sellList"; }
      //toastr.success('Edited Successfully', 'Success',{timeOut: 3000,progressBar: true});
    }  
    });  
  });


</script>

</body>
</html>