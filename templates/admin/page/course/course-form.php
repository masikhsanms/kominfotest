<?php 
# edit form
$id = !isset($_GET['id']) ? '' : base64_decode( $_GET['id'] ) ?? '';

$value_action = empty($id) ? 'tambah_data' : 'edit_data';
$label = empty($id) ? 'Tambah '.ucfirst($page) : 'Edit '.ucfirst($page); 
$cek_required = empty($id) ? 'required' : '';

if( isset($_GET['id']) ){
    $tb_course  = 'courses';
    $andwhere = " AND id='".$id."'"; 
    $getrow = (object) DB::getRowDB($tb_course,$andwhere); 
}
$nama_course = !empty( $getrow ) ? $getrow->course : '';
$mentor = !empty( $getrow ) ? $getrow->mentor : '';
$title = !empty( $getrow ) ? $getrow->title : '';

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
              <li class="breadcrumb-item"><a href="#">course</a></li>
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
                                <label>Nama course <span class="required">*</span></label>
                                <input required value="<?= $nama_course; ?>" type="text" placeholder="Masukan Nama course ..." name="nama_course" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Mentor <span class="required">*</span></label>
                                <input required value="<?= $mentor; ?>" type="text" placeholder="Masukan Mentor ..." name="mentor" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Title <span class="required">*</span></label>
                                <input required value="<?= $title; ?>" type="text" placeholder="Masukan Title ..." name="title" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
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