<!-- Navbar -->
<nav class="navbar sticky-top sticky-top navbar-expand-lg navbar-light bg-light ">
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
        if($detail != '')
        {
          echo '<li class="nav-item active bg-success bg-gradient font-weight-bold border border-2 rounded-pill">
                  <a class="nav-link text-light" href="/index.php?controller=home">Thông tin cá nhân</a>
                </li>';
        }
        else
        {
          echo '<li class="nav-item">
                  <a class="nav-link" href="/index.php?controller=home">Thông tin cá nhân</a>
                </li>';
        }
        ?>
        
        <!-- <li class="nav-item dropdown"> -->
        <?php
        if($deposit != '' || $draw != '' || $transfer != '' || $phonecard != '')
        {
          echo '<li class="nav-item dropdown active bg-success bg-gradient font-weight-bold border border-2 rounded-pill">
            <a class="nav-link text-light" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Các giao dịch</a>';
        }
        else
        {
          echo '<li class="nav-item dropdown">
            <a class="nav-link" href="" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Các giao dịch</a>';
        }
        
        ?>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li>
                
                <?php
                if($deposit != '')
                {
                  echo '<a class="dropdown-item active bg-success bg-gradient text-light font-weight-bold border border-2 rounded-pill" href="/index.php?controller=home&action=deposit"><img src="images/icons8-deposit-24.png" class="mr-2">Nạp tiền</a>';
                }
                else
                {
                  echo '<a class="dropdown-item" href="/index.php?controller=home&action=deposit"><img src="images/icons8-deposit-24.png" class="mr-2">Nạp tiền</a>';
                }
                ?>
                
              </li>
              <li>
                <?php
                if($draw != '')
                {
                  echo '<a class="dropdown-item active bg-success bg-gradient text-light font-weight-bold border border-2 rounded-pill" href="/index.php?controller=home&action=draw"><img src="images/icons8-initiate-money-transfer-24.png" class="mr-2">Rút tiền</a>';
                }
                else
                {
                  echo '<a class="dropdown-item" href="/index.php?controller=home&action=draw"><img src="images/icons8-initiate-money-transfer-24.png" class="mr-2">Rút tiền</a>';
                }
                ?>
              </li>
              <li>
                <?php
                if($transfer != '')
                {
                  echo '<a class="dropdown-item active bg-success bg-gradient text-light font-weight-bold border border-2 rounded-pill" href="/index.php?controller=home&action=transferinfo"><img src="images/icons8-money-transfer-24.png" class="mr-2">Chuyển tiền</a>';
                }
                else
                {
                  echo '<a class="dropdown-item" href="/index.php?controller=home&action=transferinfo"><img src="images/icons8-money-transfer-24.png" class="mr-2">Chuyển tiền</a>';
                }
                ?>
              </li>
              <li>
                <?php
                if($phonecard != '')
                {
                  echo '<a class="dropdown-item active bg-success bg-gradient text-light font-weight-bold border border-2 rounded-pill" href="/index.php?controller=home&action=phonecard"><img src="images/icons8-cell-phone-24.png" class="mr-2">Mua thẻ điện thoại</a>';
                }
                else
                {
                  echo '<a class="dropdown-item" href="/index.php?controller=home&action=phonecard"><img src="images/icons8-cell-phone-24.png" class="mr-2">Mua thẻ điện thoại</a>';
                }
                ?>
              </li>
            </ul>
        </li>
        
        <!-- <li class="nav-item"> -->
        <?php
        if($transhis != '')
        {
          echo '<li class="nav-item active bg-success bg-gradient font-weight-bold border border-2 rounded-pill">
            <a class="nav-link text-light" href="/index.php?controller=home&action=transhis">Lịch sử giao dịch</a>';
        }
        else
        {
          echo '<li class="nav-item">
            <a class="nav-link" href="/index.php?controller=home&action=transhis">Lịch sử giao dịch</a>';
        }
        ?>
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
          <li><a class="dropdown-item" href="/index.php?controller=login&action=changepassword"><img class="mr-2" src="images/icons8-password-reset-64.png" width="24" height="24">Thay đổi mật khẩu</a></li>
          <li><a class="dropdown-item" href="/index.php?controller=login&action=logout"><img class="mr-2" src="images/icons8-logout-24.png">Đăng xuất</a></li>
        </ul>
      </div>
    </div>
    <!-- Right elements -->

  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar --> 
<!-- Example single danger button -->
<!-- Swiper -->
<!-- 
<div class="container col-12">
<div class="swiper mySwiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="/images/slide_page_2.jpg" /></div>
    <div class="swiper-slide"><img src="/images/slide_page_3.jpg" /></div>
    <div class="swiper-slide"><img src="/images/slide_page_4.jpg" /></div>
    <div class="swiper-slide"><img src="/images/slide_page_5.jpg" /></div>
    <div class="swiper-slide"><img src="/images/slide_page_7.jpg" /></div>
    <div class="swiper-slide"><img src="/images/slide_page_8.jpg" /></div>
    <div class="swiper-slide"><img src="/images/slide_page_9.jpg" /></div>
  </div>
  <div class="swiper-pagination"></div>
</div>
</div> -->



