  <?php 
  $level  = $_SESSION['level'];
  $email  = $_SESSION['email'];

  $page   = $_GET['page'] ?? '';

  $data_user = $users->get_userlogin($email);
  ?>
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin LTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/avatar-df.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php?page=profil" class="d-block"><?= ucfirst( $data_user['username'] ); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="?page=home" class="nav-link <?= $page == 'home' || $page=="" ? 'active' :''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          
          <?php if( $level == 'admin' || $level == 'admin' ): ?>
          <li class="nav-item">
            <a href="?page=users" class="nav-link <?= $page == 'users' ? 'active' :''; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <?php endif; ?>

          <?php if( $level == 'staf' || $level == 'admin' ): ?>
          <li class="nav-item">
            <!-- <a href="?page=daerah" class="nav-link <?= $page == 'daerah' ? 'active' :''; ?>"> -->
            <a href="?page=course" class="nav-link <?= $page == 'course' ? 'active' :''; ?>">
              <i class="nav-icon fas fa-map"></i>
              <p>
                Course
              </p>
            </a>
          </li>
          <?php endif; ?>
          
          <?php if( $level == 'staf' || $level == 'admin' ): ?>
          <li class="nav-item">
            <a href="?page=pesertacourse" class="nav-link <?= $page == 'pesertacourse' ? 'active' :''; ?>">
              <i class="nav-icon fas fa-luggage-cart"></i>
              <p>
                Peserta Course
              </p>
            </a>
          </li>
          <?php endif; ?>

          <?php if( $level == 'admin' ): ?>
          <li class="nav-item">
            <a href="?page=detail" class="nav-link <?= $page == 'detail' ? 'active' :''; ?>">
              <i class="nav-icon fas fa-poll-h"></i>
              <p>
                Detail
              </p>
            </a>
          </li>
          <?php endif; ?>
          <!-- <li class="nav-item">
            <a href="home.php" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Lihat Website
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-external-link-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>