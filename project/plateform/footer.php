<!-- jQuery -->
<script src="../../font/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../font/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../font/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../font/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../font/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../font/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../font/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../font/plugins/moment/moment.min.js"></script>
<script src="../../font/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../font/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../font/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../font/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../font/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../font/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../font/dist/js/pages/dashboard.js"></script>
<script src="../js/sweetalert2.all.min.js"></script>
<?php 
   if(isset($_SESSION['status']) && $_SESSION['status'] != ''){

?>
<script>
  Swal.fire({
    title: "<?php echo $_SESSION['status']; ?>!",
    //text: "!",
    icon: "<?php echo $_SESSION['status_code'];?>",
    timer: 1500
  });
</script>
<?php unset($_SESSION['status']);
 } ?>
<script src="../js/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>
