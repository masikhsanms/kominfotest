<?php 
global $usercourse;

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
                                <label>Nama Peserta <span class="required">*</span></label>
                                
                                <select name="id_user" class="form-control" required>
                                <option value="">Pilih Nama Peserta</option>
                                    <?php foreach($usercourse->list_users() as $row){ ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['username']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Course <span class="required">*</span></label>
                                <select name="id_course" class="form-control" required>
                                    <option value="">Pilih Kursus</option>
                                    <?php foreach($usercourse->list_courses() as $row){ ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['course'] .'-'.$row['title'].' '.$row['mentor']; ?></option>
                                    <?php } ?>
                                </select>                            
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