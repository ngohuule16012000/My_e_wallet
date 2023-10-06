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

<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Thay đổi mật khẩu</p>

                <!-- form -->
                <form class="mx-1 mx-md-4" action="/index.php?controller=login&action=checkchange" method="post">
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 border">
                        <input type="password" id="password" class="form-control" name="password" placeholder="Current Password" required/>
                      
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 border">
                        <input type="password" id="newpassword1" class="form-control" name="newpassword1" placeholder="New Password" required/>
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0 border">
                        <input type="password" id="newpassword2" class="form-control" name="newpassword2" placeholder="Password Again" required/>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" type="button" class="btn btn-primary btn-lg">Thay đổi</button>
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