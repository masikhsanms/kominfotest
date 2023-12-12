<?php 

if( $_SESSION['level'] == 'user' ){
  header('Location:index.php');
} 

# edit form
$id = !isset($_GET['id']) ? '' : base64_decode( $_GET['id'] ) ?? '';

$value_action = empty($id) ? 'tambah_data' : 'edit_data';
$label = empty($id) ? 'Tambah '.$page : 'Edit '.$page; 
$cek_required = empty($id) ? 'required' : '';

if( isset($_GET['id']) ){
  $tb_user  = 'users';
  $andwhere = " AND id='".$id."'"; 
  $getrow = (object) DB::getRowDB($tb_user,$andwhere); 
}

$nama = !empty( $getrow ) ? $getrow->username : '';
$level = !empty( $getrow ) ? $getrow->level : '';
$email = !empty( $getrow ) ? $getrow->email : '';

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

?>

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $label; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Users</a></li>
              <li class="breadcrumb-item active"><?= $label; ?></li>
            </ol>
          </div>

          <?php if(isset($_GET['msg'])): ?>
            <!-- Error Message -->
            <div class="col-md-12">
              <div class="alert alert-danger" role="alert">
                <?= $msg; ?>
              </div>
            </div>
          <?php  endif; ?>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Form <?= $label; ?></h3>
              </div>
              <!-- /.card-header -->
          
              <!-- form start -->
              <form method="POST" action="">
                <input type="hidden" name="action" value="<?= $value_action; ?>">                
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-6"> 
                        <div class="form-group">
                          <label for="nama-<?= $act; ?>">Username</label>
                          <input required value="<?= $nama; ?>" type="text" name="nama" autocomplete="off" class="form-control" id="nama-<?= $act; ?>" placeholder="Masukan Nama ...">
                        </div>
                        <div class="form-group">
                          <label for="pass-<?= $act; ?>">Password</label>
                          <input <?= $cek_required; ?>  type="password" autocomplete="off" name="password" class="form-control" id="pass-<?= $act; ?>" placeholder="Masukan Password ...">
                        </div>
                        <div class="form-group">
                            <label>Pilih Level User</label>
                            <select name="level"  class="form-control" id="level-<?= $act; ?>" required>
                                <?= select_level_user($level); ?>
                            </select>
                        </div>
                      </div> <!-- end col-md-6 -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email-<?= $act; ?>">Email</label>
                          <input required type="email" value="<?= $email; ?>" name="email" autocomplete="off" class="form-control" id="email-<?= $act; ?>" placeholder="Masukan Email ...">
                        </div>
                        <div class="form-group">
                          <label for="pass-konfirmasi-<?= $act; ?>">Password Konfirmasi</label>
                          <input <?= $cek_required; ?> type="password" autocomplete="off" name="pass-konfirmasi" class="form-control" id="pass-<?= $act; ?>" placeholder="Konfirmasi Password  ...">
                          <span id='message'></span>
                        </div>
                      </div> <!-- end col-md-6 -->
                  </div> <!-- end row -->

                  <?php if( isset($_GET['id']) ): ?>
                  <div class="alert alert-warning" role="alert">
                    Jika Password Tidak Ingin Dirubah Dikosongkan saja <span class="float-right text-white"><i class="fas fa-info-circle"></i></span>
                  </div>
                  <?php endif; ?>

                </div> <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-info ">Submit</button>
                </div>
                
              </form>

            </div>
            <!-- /.card -->

          </div>
          <!--/.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>