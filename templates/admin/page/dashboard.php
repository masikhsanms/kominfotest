<?php
global $dashboard;
$count = $dashboard->count_data();
?>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- content page -->
        <div class="row">
          <div class="col-md-12">
            <?php 
              $email = $_SESSION['email'];
              $get_user = DB::getRowDB('users'," AND email='".$email."' LIMIT 1");
            ?>
            <h5 class="alert alert-success">Hai Selamat datang, <?php echo $get_user['username']; ?>! anda telah login. <i class="fa fa-info-circle float-right"></i></h5>
          </div>

          <?php if( $_SESSION['level'] == 'admin' ): ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Data</h3>

                <p>Detail Course</p>
              </div>
              <div class="icon">
                <i class="ion ion-arrow-graph-up-right"></i>
              </div>
              <a href="?page=prediksi" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php endif; ?>
          <!-- ./col -->
          <?php if( $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'staf'  ): ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $count['kecamatan']; ?></h3>

                <p>Course</p>
              </div>
              <div class="icon">
                <i class="ion ion-map"></i>
              </div>
              <a href="?page=daerah" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php endif; ?>
          <!-- ./col -->
          <?php if( $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'staf'  ): ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $count['produksi']; ?></h3>

                <p>Jumlah Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="?page=produksi" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php endif; ?>
          <!-- ./col -->
          <?php if( $_SESSION['level'] != 'staf' ): ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $count['pengguna']; ?></h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="?page=users" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php endif; ?>
        </div>
        <!-- /.row -->
 
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<!-- Small boxes (Stat box) -->