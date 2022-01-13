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
                          <div>
                          </div>
                          <div class="alert alert-info" style="display: none;">
                          </div>
                            <div class="form-group">
                               <select class="form-control" name="cateogry" id="category_id">
                                 <option value="">Select Category</option>
                                <?php foreach ($cats as $value) {; ?>
                                 <option  value="<?php echo$value->id;?>"><?php echo$value->cat_name;?></option>
                                <?php }?>
                               </select>
  
                            </div> 
                            <div class="text-danger category" style="display:none;line-height: 0px;"></div>
                            <div class="form-group">
                                <input name="sub_name" id="sub_name" placeholder="Subcategory Name" class="form-control" type="text">
                            </div>
                            <div class="text-danger subcat" style="display: none;line-height: 0px;"></div>
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



<!-- REQUIRED SCRIPTS -->

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
      "url": "<?php echo base_url('Subcategory/list_subcategory')?>",
      "type": "POST"
      },
      "columnDefs": [
      { 
      "targets": [ -1 ],
      "orderable": false,
      },
      ],
    });

    function add_subcategory()
    {
      save_method = 'add';
      $('#form')[0].reset();
      $('#modal_category').modal('show');
      $('.modal-title').text('Add Subcategory');
    }

    function edit_category(id)
    {
        save_method = 'update';
        $('#form')[0].reset();
        $.ajax({
            url : "<?php echo site_url('Subcategory/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="cateogry"]').val(data.id);
                $('[name="id"]').val(data.sub_id);
                $('[name="sub_name"]').val(data.sub_name);
                $('#modal_category').modal('show'); 
                $('.modal-title').text('Edit Subategory'); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function save()
    {
      var data = $('#form').serialize();
      var sub_name = $("#sub_name").val();
      var id = $("#category_id").val();
    if(id == ''){
       $('.category').html('<p>Please select category</p>').css({"color": "white", "font-weight": "normal"}).fadeIn().delay(1500).fadeOut('slow');
      }
      else if(sub_name == '')  
      {  
       $('.subcat').html('<p>Please enter a subcategory name</p>').css({"color": "white", "font-weight": "normal"}).fadeIn().delay(1500).fadeOut('slow');
      }

      else
      {
        $('#btnSave').text('saving...'); 
        $('#btnSave').attr('disabled',true); 
        var url;
     
        if(save_method == 'add') {
            url = "<?php echo site_url('Subcategory/ajax_add')?>";
            $.ajax({
                url : url,
                type: "POST",
                data: {id:id,sub_name:sub_name}, 
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        $('#modal_category').modal('hide');
                        reload_table();
                        toastr.success('Subcategory added successfully', 'Success',{timeOut: 5000,progressBar: true,})
                    }
                    else
                    {
                   //$('.alert-info').html('This category name is already exist').fadeIn().delay(1500).fadeOut('slow');
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
            url = "<?php echo site_url('Subcategory/ajax_update')?>";
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
                   //$('.alert-info').html('This category name is already exist').fadeIn().delay(1500).fadeOut('slow');
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
    function reload_table()
    {
      table.ajax.reload(null,false); 
    }

    function subcat_delete(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            $.ajax({
                url : "<?php echo site_url('Subcategory/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    $('#modal_category').modal('hide');
                    reload_table();
                    toastr.success('Subcategory deleted successfully', 'Success',{timeOut: 5000,progressBar: true,});
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