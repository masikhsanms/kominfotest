<?php ob_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://kulonprogokab.go.id/v3/aset_landing/images/logo_kp.png">

    <title>Data Kulonprogo</title>

      <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css"> -->
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- datepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

  </head>

  <body class="bg-light">

<?php 
session_start();
include 'koneksi.php';

# includes function
$nama_fungsi = [
  'functions-general',
  'functions-users',
];
foreach( $nama_fungsi as $fungsi ){
  include 'includes/'.$fungsi.'.php';
}

# includes class
$nama_class = [
  'sql',
  'users',
  'daerah',
  'kategori',
  'produksi',
  'prediksi',
  'dashboard',
  'login',
  'course'
];
foreach( $nama_class as $class ){
  include 'classes/class-'.$class.'.php';
}

$folder_templates = 'templates';

$tahun_awal = DB::getRowDB('produksi'," GROUP BY tahun ASC ")['tahun'];
$tahun_akhir = DB::getRowDB('produksi'," GROUP BY tahun DESC ")['tahun'];

$periode_tahun = $tahun_awal .' - '.$tahun_akhir;
?>

    <div class="container">
      <?php if( empty($_SESSION['email']) ): ?>
      <div class="row">
        <div class="col-md-12 mt-4">
          <div class="btn-login float-right">
              <a href="index.php" class="btn btn-primary"> <i class="fa fa-user"></i> Login</a>
          </div>
        </div>
      </div>
      <?php else: ?>
        <div class="row">
        <div class="col-md-12 mt-4">
          <div class="btn-login float-right">
              <a href="index.php" class="btn btn-success"> <i class="fa fa-user"></i> Akun Saya</a>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://kulonprogokab.go.id/v3/portal/files/file_uploads/8c2017f46cb52374c0e59bc07ad7cc1c.png" alt="" style="width:70px;">
        <h2>KULONPROGO</h2>
        <p class="lead">Prediksi Hasil Produksi Padi di Kulonprogo Periode 5 Tahun ( <?= $periode_tahun; ?> )  </p>
      </div>

      <?php include $folder_templates.'/frontend/prediksi.php';  ?>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; <?= date('Y'); ?> Skripsi Amin SPK Moving Avarage</p>
        
      </footer>
    </div>

  <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <!-- <script src="assets/plugins/sparklines/sparkline.js"></script> -->
    <!-- JQVMap -->
    <!-- <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script> -->
    <!-- <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
    <!-- jQuery Knob Chart -->
    <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="assets/dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="assets/dist/js/pages/dashboard.js"></script> -->

    <!-- DataTables  & Plugins -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/plugins/jszip/jszip.min.js"></script>
    <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

  </body>
</html>
