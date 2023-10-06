<?php
if ($error !== '' || $success !== ''){
  echo '<div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-9 m-4">';
        // <!-- Success Alert -->
        
          if ($success !== '')
          {
            echo '<div class="alert alert-success alert-dismissible fade show">' .
              '<strong></strong> <span> ' . $success . '</span>' .
              // '<p><span>Username: </span>'. $username .'</p>'.
              // '<p><span>Password: </span>'. $password .'</p>'.
              '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' .
              '</div>' ;
          }
      
        // <!-- Error Alert -->
        
          if ($error !== ''){

            echo  '<div class="alert alert-danger alert-dismissible fade show">'.
              '<strong></strong><span>' . $error . '</span> ' .
              ' <button type="button" class="btn-close" data-bs-dismiss="alert">'.
              '</button> '.
              '</div>';
          }
  echo '
      </div>
    </div>
  </div>';
} ?>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng ký tài khoản</p>

                <!-- form -->
                <form class="mx-1 mx-md-4" action="/index.php?controller=register&action=check" method="post" enctype="multipart/form-data">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-phone fa-lg me-3 fa-fw"></i>
                    <div class=" form-group form-outline flex-fill mb-0 border">
                        <!-- <label class="form-label" for="phone">Your phone</label> -->
                        <input type="tel" pattern="^\d{10}$" id="phone" class="form-control" name="phone" placeholder="Your phone" required/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 border">
                        <!-- <label class="form-label" for="email">Your Email</label> -->
                        <input type="email" id="email" class="form-control" name="email" placeholder="Your Email" required/>
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user-alt fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 border">
                      <!-- <label class="form-label" for="fullname">Full name</label> -->
                      <input type="text" id="fullname" class="form-control" name="fullname" placeholder="Full name" required/>
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-birthday-cake fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 border">
                      <!-- <label class="form-label" for="date">Your date</label> -->
                      <input type="date" id="date" class="form-control" name="date" placeholder="Your date" required/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-address-book fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 border">
                      <!-- <label class="form-label" for="address">Your address</label> -->
                      <input type="text" id="address" class="form-control" name="address" placeholder="Your address" required/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="	fa fa-cloud-upload fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label for="fontimage" class="form-label">Ảnh mặt trước chứng minh nhân dân</label>
                      <input class="form-control border" id="fontimage" name="fontimage" type="file" required/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="	fa fa-cloud-upload fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label for="backimage" class="form-label">Ảnh mặt sau chứng minh nhân dân</label>
                      <input class="form-control border" id="backimage" name="backimage" type="file" required/>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name='submitregister' class="btn btn-primary btn-lg">Đăng ký</button>
                  </div>

                  <div class=" d-flex justify-content-center mb-5">
                      <span> Đăng nhập tại <a href="http://localhost:8080/index.php?controller=login" id="log">đây</a> </span>
                  </div>

                </form>
                <!-- end form -->
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>