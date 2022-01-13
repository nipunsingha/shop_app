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



<!-- modal -->
<div class="modal fade" id="modal_category" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Person Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                          <div class="alert alert-danger" style="display: none;">
                          </div>
                          <div class="alert alert-info" style="display: none;">
                          </div>
                            <div class="form-group">
                                <input type="hidden" value="" name="id"/> 
                                <input name="cat_name" id="cat_name" placeholder="Category Name" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-flat">Save</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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
      $('#productlist').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": false,
    });
  table = $('#example2').DataTable({
      "processing": true,
      "serverSide": true, 
      "order": [],
      "ordering": false,
      "ajax": {
      "url": "<?php echo base_url('Category/cateList')?>",
      "type": "POST"
      },
      "columnDefs": [
      { 
      "targets": [ -1 ],
      "orderable": false,
      },
      ],
    });
    function add_category()
    {
      save_method = 'add';
      $('#form')[0].reset();
      $('#modal_category').modal('show');
      $('.modal-title').text('Add Category');
    }
    function edit_category(id)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $.ajax({
            url : "<?php echo site_url('Category/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id);
                $('[name="cat_name"]').val(data.cat_name);
                $('#modal_category').modal('show'); 
                $('.modal-title').text('Edit Category'); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table()
    {
      table.ajax.reload(null,false); 
    }
    function save()
    {
      var data = $('#form').serialize();
      var cat_name = $("#cat_name").val();
      if(cat_name == '')  
      {  
       $('.alert-danger').html('Please enter a category name').css({"color": "white", "font-weight": "normal"}).fadeIn().delay(1500).fadeOut('slow');
      }
      else
      {
        $('#btnSave').text('saving...'); 
        $('#btnSave').attr('disabled',true); 
        var url;
     
        if(save_method == 'add') {
            url = "<?php echo site_url('Category/ajax_add')?>";
            $.ajax({
                url : url,
                type: "POST",
                data: data, 
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        $('#modal_category').modal('hide');
                        reload_table();
                        toastr.success('Category added successfully', 'Success',{timeOut: 5000,progressBar: true,})
                    }
                    else
                    {
                   $('.alert-info').html('This category name is already exist').fadeIn().delay(1500).fadeOut('slow');
                    }
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save');
                    $('#btnSave').attr('disabled',false); 
                }
            });
        }
        else 
        {
            url = "<?php echo site_url('Category/ajax_update')?>";
            $.ajax({
                url : url,
                type: "POST",
                data: data, 
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status) 
                    {
                        $('#modal_category').modal('hide');
                        reload_table();
                        toastr.success('Category updated successfully', 'Success',{timeOut: 5000,progressBar: true,})
                    }
                    else
                    {
                   $('.alert-info').html('This category name is already exist').fadeIn().delay(1500).fadeOut('slow');
                    }
                    $('#btnSave').text('save'); 
                    $('#btnSave').attr('disabled',false); 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('save'); 
                    $('#btnSave').attr('disabled',false);  
                }
            });
        }
     
        }
    }

    function delete_person(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            $.ajax({
                url : "<?php echo site_url('Category/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    $('#modal_category').modal('hide');
                    reload_table();
                    toastr.success('Category deleted successfully', 'Success',{timeOut: 5000,progressBar: true,});
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
     
        }
    }


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
               $("#p_sub").html(data.sub_name);
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

</script>
</body>
</html>
