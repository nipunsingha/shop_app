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



<!-- view modal -->
<div class="modal fade" id="modal_productview" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none">
                <h4 class="modal-title" id="myModalLabel"><i class="text-muted fas fa-info-circle"></i> Stokes Detail </h4>
<!--                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                   <div class="col-md-12">
                      <table class="table table-bordered">
                             <tbody>
                                  <tr>
                                    <th>Quantity</th>
                                    <td id="p_qty"></td>
                                  </tr>
                                  <tr>
                                    <th>Sell Quantity</th>
                                    <td id="p_sell_qty"></td>
                                  <tr>
                                    <th>Remain Quantity</th>
                                    <td id="p_r_qty"></td>
                                  </tr>
                             </tbody>
                        </table>
                   </div> 
                </div>
            </div>
            <div class="modal-footer" style="border-top: none;">
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

 $('#usertable').DataTable({
 });

 $('#viewQty').DataTable({
 });


    $(document).ready(function() {

      $('.view_detail').click(function(){
          
          var sl_code = $(this).attr('relid'); //get the attribute value

          $.ajax({
              url : "<?php echo base_url(); ?>Stokes/viewStokesbyid",
              data:{sl_code : sl_code},
              method:'GET',
              dataType:'json',
              success:function(data) {
               $("#p_qty").html(data.p_qty);
               $("#p_sell_qty").html(data.p_sell_qty);
               $("#p_r_qty").html(data.p_r_qty);
                //$('#show_modal').modal({backdrop: 'static', keyboard: true, show: true});
                $('#modal_productview').modal('show');
            }
          });
      });
    });
</script>
</body>
</html>
