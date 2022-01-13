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

<!-- DataTables -->
<script src="<?php echo base_url()?>webroot/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>webroot/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>webroot/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url()?>webroot/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url()?>webroot/dist/js/active.js"></script>

<script>

  table = $('#list').DataTable({
      "processing": true,
      "serverSide": true, 
      "order": [],
      "ordering": false,
      "ajax": {
      "url": "<?php echo base_url(); ?>Sell/list_sell",
      "type": "POST"
      },
      "columnDefs": [
      { 
      "targets": [ -1 ],
      "orderable": false,
      },
      ],
    });

  function checkDelete(){
      return confirm('Are you sure?');
  }
  

    function delete_sell(id)
    {
  
        if(confirm('Are you sure delete this data?'))
        {
            $.ajax({
                url : "<?php echo site_url('Sell/sellDelete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    // $('#modal_category').modal('hide');
                    // //reload_table();
                    // toastr.success('Category deleted successfully', 'Success',{timeOut: 5000,progressBar: true,});
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