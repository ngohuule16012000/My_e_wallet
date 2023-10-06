<?php
if ($error !== ''){
  echo '<div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-9 m-4">
        <!-- Error Alert -->
          <div class="alert alert-danger alert-dismissible fade show">
              <strong></strong><span>' . $error . '</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert">
              </button>
              </div>
          
      </div>
    </div>
  </div>';
}
?>
<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Khôi phục mật khẩu</p>

                <!-- form -->
                <form class="mx-1 mx-md-4" action="/index.php?controller=login&action=recoverycheck" method="post">

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

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" type="button" class="btn btn-primary btn-lg">Khôi phục</button>
                  </div>

                  <div class=" d-flex justify-content-center m-b-3">
                      <span> Đăng nhập tại <a href="/index.php?controller=login" id="log">đây</a> </span>
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