<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy;.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!--modal-->
   <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header style-border">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Sample Modal</h4>             
          </div>
        <div class="modal-body">
        <div class="alert alert-danger" style="display: none;"></div>
            <form id="userForm" method="post">
                 <input type="hidden" id="updateId" name="updateId" value="0">
                 <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" id="name" class="form-control"/>
                 </div>

                 <div class="form-group">
                     <label for="name">Username</label>
                     <input type="text" name="username" id="username" class="form-control"/>
                 </div>

                 <div class="form-group">
                     <label for="name">Password</label>
                     <input type="password" name="password" id="password" class="form-control"/>
                 </div>

                 <div class="form-group">
                     <label for="level">User Role</label>
                     <select name="level" id="level" class="form-control">
                            <option value="">Select</option> 
                            <option value="admin">Admin</option> 
                            <option value="editor">Editor</option> 
                     </select>
                 </div>
                 <div class="form-group">
                     <button type="submit" id="btnSave" class="btn btn-success">Update</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
            </form>
        </div>
      </div>
   </div>
 </div> 


<!-- jQuery -->
<script src="<?php echo base_url()?>webroot/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>webroot/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo base_url()?>webroot/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- ionicons -->
<script src="<?php echo base_url()?>webroot/plugins/ionicons/ionicons.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>webroot/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url()?>webroot/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>webroot/dist/js/demo.js"></script>
<script src="<?php echo base_url()?>webroot/dist/js/active.js"></script>
<!-- page script -->
<script>

  table = $('#usertable').DataTable({
      "processing": true,
      "serverSide": true, 
      "order": [],
      "ordering": false,
      "ajax": {
      "url": "<?php echo site_url('User/userlist')?>",
      "type": "POST"
      },
      "columnDefs": [
      { 
      "targets": [ -1 ],
      "orderable": false,
      },
      ],
    });


  function reload_table(){
    table.ajax.reload(null,false); 
  }

$("#userform").validate({
    rules: {
        name: {
            required: true,

        },
        username: {
            required: true,
            remote: {
                url: "<?php echo base_url();?>User/userNameExst",
                type: "post"
             }            

        },

        level: {
            required: true,

        },

        password: {
            required: true,
            minlength: 6

        },                                  
    },
    messages: {
        name: {
            required: "This field is required",

        },
        username: {
            required: "This field is required",
            remote:   "The username already exists. Please use a different username"
        },

        level: {
            required: "This field is required",
        },

        password: {
            required: "This field is required",
            minlength: "Please enter at least 6 characters"
        },                                    
    }
});


 //fetch data by Id
  $(document).on('click', '#editBtnId', function(e){
    e.preventDefault();
    $("#myModal").modal("show");
    $("#myModal").find(".modal-title").text('Edit user');
    $('#userForm').attr('action', '');
    var id = $(this).attr('data-editBtnId');
    $.ajax({
      type: 'ajax',
      method: 'post',
      url: '<?php echo base_url();?>/User/ajax_edit',
      data: {id: id},
      async: false,
      dataType: 'json',
      success: function(data){
        $("#name").val(data.name);
        $("#username").val(data.username);
        $("#level").val(data.level);
        $("#updateId").val(data.u_id);
      },
      error: function(){
        alert('Could not Edit Data');
      }
    });        
  });


  //update
  $(document).on('click', '#btnSave', function(event){  
       event.preventDefault();

       var data = $('#form').serialize();
       var hasError = false;
       var name = $('#name').val();  
       var username = $('#username').val();
       var level = $('#level').val();

       var password = $('#password').val();

       var updateId = $('#updateId').val();

        if (name == '') {
            $('.alert-danger').html('Name can not empty!').fadeIn().delay(1500).fadeOut('slow');
            hasError = true;
        } else if (username == '') {
            $('.alert-danger').html('Username can not empty!').fadeIn().delay(1500).fadeOut('slow');
            hasError = true;
        } else if (level == '' ) {
            $('.alert-danger').html('Level is required!').fadeIn().delay(1500).fadeOut('slow');
            hasError = true;
        }else if(password != ''){
          if (password.length < 6){
            $('.alert-danger').html('Please enter at least 6 characters').fadeIn().delay(1500).fadeOut('slow');
            hasError = true;
          }
        }


      if(hasError == true) {return false;}

       if(hasError == false){ 
      
            $.ajax({  
                 url:"<?php echo base_url();?>/User/ajax_update",  
                 method:'POST',  
                 data:{name:name, username:username, password:password,level:level, updateId:updateId},   
                 success:function(data)  
                 {

     
                      $('#userForm')[0].reset();  
                      $('#myModal').modal('hide');                  
                       toastr.success('User Update successfully', 'Success Alert',{timeOut: 3000,progressBar: true}); 
                       reload_table();
              
                      
                 }  
            });
             
       }  
       else  
       {  
            $('.alert-danger').html('Name or User role can not be empty!').fadeIn().delay(5000).fadeOut('slow');  
       }  
  });


    function delete_person(id)
    {
        if(confirm('Are you sure?'))
        {
            $.ajax({
                url : "<?php echo site_url('User/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    $('#modal_category').modal('hide');
                    reload_table();
                    toastr.success('User deleted successfully', 'Success',{timeOut: 5000,progressBar: true,});
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
     
        }
    }


</script>
</body>
</html>
