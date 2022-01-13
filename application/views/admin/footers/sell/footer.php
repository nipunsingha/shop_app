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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
  $(document).ready(function(){
   function load_customer(searchkey)
     {
        var searchkey = $('#searchkey').val();
        $.ajax({
         url:"<?php echo base_url(); ?>Sell/customerList",
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
         url:"<?php echo base_url(); ?>Sell/fetch",
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



  $(document).on('submit', '#productItems', function(e){
    e.preventDefault();
    var data = $('#productItems').serialize();
    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/insertSell",  
    data: data,    
    success: function(data){ 
       $('#card-custom').hide();
       $('form#productItems')[0].reset();
       $('#search')[0].reset();
       // $("span").addClass("overlay");
       loadData();
       // toastr.success('Product successfully added to cart ', 'Success',{timeOut: 5000,progressBar: true});
    }  
    });  
  });

function deleteItem(id)
{
    if(confirm('Are you sure delete this Item?'))
    {
        $.ajax({
            url : "<?php echo site_url('Sell/deleteItem')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //toastr.success('Category added successfully', 'Success',{timeOut: 5000,progressBar: true})
                loadData();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}


  $(document).on('keyup', '#sl_discount', function(e){
    e.preventDefault();
    var totalprice = $("#totalprice").html();
    var discount = $("#sl_discount").val();
    
    var finalprice = totalprice - discount;

    var grandprice = $("#grandprice").html(finalprice);
      
  });


loadData();
function loadData(){   
$.ajax({
    url:"<?php echo base_url();?>Sell/sellItem",
    type: 'POST',
    dataType: 'JSON',

    success:function (data) {
        $('#data_html').html(data);
    }
});
}


  $(document).on('click', '#soldbtn', function(e){
    e.preventDefault();
    //var data = $('#addSoldItem').serialize();
    var c_id = $("#c_id").val();
    var sl_discount = $("#sl_discount").val();
    var sl_total = $("#sl_total").val();
    

    $.ajax({  
    type: "POST",  
    url:  "<?php echo base_url();?>Sell/insertSaleItem",  
    data: {c_id:c_id, sl_discount:sl_discount, sl_total:sl_total},    
    success: function(data){ 
      $('form#customerForm')[0].reset();

      toastr.options.onHidden = function() { window.location.href = "<?php echo base_url();?>Sell/sellList"; }

      toastr.success('Product successfully added to cart ', 'Success',{timeOut: 3000,progressBar: true});
    }  
    }); 

  });

  function customerPage()
  {
   window.location.href = "<?php echo base_url();?>Customer/Customer";
  }

</script>

</body>
</html>