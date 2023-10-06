<!-- Navbar -->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="/images/icons8-online-shop-card-payment-64.png" ></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php 
          if($verify === 'verify') 
            echo '<li class="nav-item active bg-warning bg-gradient font-weight-bold border border-2 rounded-pill">';
          else
            echo '<li class="nav-item">';?>
          <a class="nav-link" href="/index.php?controller=admin">Chờ kích hoạt</a>
        </li>
        <?php 
          if($confirmed === 'confirmed') 
            echo '<li class="nav-item active bg-warning bg-gradient font-weight-bold border border-2 rounded-pill">';
          else
            echo '<li class="nav-item">';?>
          <a class="nav-link" href="/index.php?controller=admin&action=confirmedaccount">Đã kích hoạt</a>
        </li>
        <?php 
          if($disable === 'disable') 
            echo '<li class="nav-item active bg-warning bg-gradient font-weight-bold border border-2 rounded-pill">';
          else
            echo '<li class="nav-item">';?>
          <a class="nav-link" href="/index.php?controller=admin&action=disableaccount">Đã vô hiệu hóa</a>
        </li>
        <?php 
          if($locked === 'locked') 
            echo '<li class="nav-item active bg-warning bg-gradient font-weight-bold border border-2 rounded-pill">';
          else
            echo '<li class="nav-item">';?>
          <a class="nav-link" href="/index.php?controller=admin&action=lockedaccount">Khóa vô thời hạn</a>
        </li>
        <?php 
          if($approve === 'approve') 
            echo '<li class="nav-item active bg-warning bg-gradient font-weight-bold border border-2 rounded-pill">';
          else
            echo '<li class="nav-item">';?>
          <a class="nav-link" href="/index.php?controller=admin&action=approve">Phê duyệt giao dịch</a>
        </li>
        
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <div>
        <strong><?= $_SESSION['name'] ?></strong>
      </div>
      <!-- Avatar -->
      <div class="dropdown mx-2">
        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar"
            data-bs-toggle="dropdown" aria-expanded="false">
          <img src="/images/avatar.png" class="rounded-circle" height="30" 
            alt="Black and White Portrait of a Man" loading="lazy"/>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
          <li><a class="dropdown-item" href="/index.php?controller=login&action=logout"><img class="mr-2" src="images/icons8-logout-24.png">Đăng xuất</a></li>
        </ul>
      </div>
    </div>
    <!-- Right elements -->

  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
