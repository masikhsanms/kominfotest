
<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | Moving Avarage</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- datepicker -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
  
</head>

<?php 

#cek login user terlebih dahulu
session_start();
if($_SESSION['status']!="login"){
  header("location:login.php?pesan=belum_login");
}

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
  'course',
  'usercourse',
  'detail',
  'kategori',
  'dashboard',
  'login',
];
foreach( $nama_class as $class ){
  include 'classes/class-'.$class.'.php';
}

?>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    <?php $folder_templates = 'templates'; ?>   
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Header Nav -->
    <?php include $folder_templates.'/admin/header.php';  ?>

    <!-- sidebar Nav -->
    <?php include $folder_templates.'/admin/sidebar.php';  ?>

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php
        
        if(isset($_GET['page'])){
          $page = $_GET['page'] ?? '';
          $act  = $_GET['act'] ?? '';
       
          switch ($page) {
            case 'home':
              include $folder_templates.'/admin/page/dashboard.php';
              break;
            case 'users':
              if( $act == 'add' ){
                include $folder_templates.'/admin/page/users/user-form.php';
              }else{
                include $folder_templates.'/admin/page/users/users.php';
              }
              break;	
            case 'course':
              if( $act == 'add' ){
                include $folder_templates.'/admin/page/course/course-form.php';
              }else{
                include $folder_templates.'/admin/page/course/course.php';
              }
              break;
            case 'pesertacourse':
              if( $act == 'add' ){
                include $folder_templates.'/admin/page/usercourse/usercourse-form.php';
              }else{
                include $folder_templates.'/admin/page/usercourse/usercourse.php';
              }
              break;
            case 'kategori':
              if( $act == 'add' ){
                include $folder_templates.'/admin/page/kategori/kategori-form.php';
              }else{
                include $folder_templates.'/admin/page/kategori/kategori.php';
              }
              break;
            case 'detail':
              include $folder_templates.'/admin/page/detail/detail.php';
              break;
            case 'profil':
              include $folder_templates.'/admin/page/profil/profil.php';
              break;					
            default:
              include $folder_templates.'/admin/page/404.php';
              break;
          }
        }else{
          include $folder_templates.'/admin/page/dashboard.php';
        }
      ?>

    
  </div>
  <!-- /.content-wrapper -->

  <!-- footer page -->
  <?php include $folder_templates.'/admin/footer.php';  ?>

</div>
<!-- ./wrapper -->

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


<!-- SPK JS -->
<script src="js/spk.js"></script>

</body>
</html>