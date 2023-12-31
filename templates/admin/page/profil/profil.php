    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

          <?php 
            global $login;
            $data_profil = $login->profil();
          ?>

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="assets/dist/img/avatar-df.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= ucfirst( $data_profil['nama'] ); ?></h3>

                <p class="text-muted text-center"><?= ucfirst( $data_profil['level'] ); ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Nama</b> <span class="float-right"><?= ucfirst( $data_profil['nama'] ); ?></span>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <span class="float-right"><?= ucfirst( $data_profil['email'] ); ?></span>
                  </li>
                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->