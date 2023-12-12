
<?php
  if( $_SESSION['level'] == 'staf' ){
    header('Location:index.php');
  } 
  $level = $_SESSION['level']; 
?>


<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Users</a></li>
              <li class="breadcrumb-item active">Data Users</li>
            </ol>
          </div>

          <?php if(isset($_GET['msg']) AND $_GET['msg'] == 'success'): ?>
            <!-- Error Message -->
            <div class="col-md-12">
              <div class="alert alert-success" role="alert">
                Data Berhasil Di Proses!
              </div>
            </div>
          <?php  endif; ?>

          <?php if(isset($_GET['msg']) AND $_GET['msg'] == 'error'): ?>
            <!-- Error Message -->
            <div class="col-md-12">
              <div class="alert alert-danger" role="alert">
                Maaf Data Failed, Something Wrong!!!
              </div>
            </div>
          <?php  endif; ?>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listing Data User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="ms-button-add">
                    <a class="btn btn-info" href="?page=<?= $page; ?>&act=add">
                        <i class="fas fa-plus-circle"></i> Tambah
                    </a>
                </div>
                <table  class="table table-bordered table-striped dt-export">
                  <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 
                    global $users;
                    $no = 1; 
                    foreach( $users->list_user() as $row ): 
                      $row = (object)$row;
                      $id = base64_encode($row->id);
                      $url_edit = '?page='.$page.'&act=add'.'&id='.$id;
                  ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->username; ?></td>
                        <td><?= $row->email; ?></td>
                        <td><?= ucfirst( $row->level ); ?></td>
                        <td>
                          <?php if( $row->level != 'admin' || $level == 'admin'  ): ?>
                          <a href="<?= $url_edit; ?>" class="text-info"><i class="fas fa-edit"></i></a>
                          <a href="javascript:void(0)" data-id="<?=$id?>" class="<?=$page.'-delete';?> text-red">
                            <i class="fas fa-trash"></i>
                          </a>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->