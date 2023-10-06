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

<div class="page-content page-container my-5">
        <div class="container d-flex justify-content-center ">
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full ">
                    <div class="row">
                        <div class="col-sm-4  bg-success">
                            <div class="h-50"></div>
                            <div class="text-center">
                                <img src="/images/icons8-deposit-64.png" height="100" class = "rounded-circle mt-10 image-deposit" >
                            </div>
                        </div>
                        <div class="col-sm-8 mt-5">
                            <div class="card-block mx-5">
                                <h5 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Nhập mã xác nhận chuyển tiền</h5>
                                <div class="row mb-5 mr-4">
                                    
                                    <!-- form -->
                                    <form class="mx-1 mx-md-4" action="/index.php?controller=home&action=otpcheck" method="post" enctype="multipart/form-data">

                                        <!-- Nhập otp code -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="otp">Mã OTP</label>
                                            <input type="text" id="otp" class="form-control border" name="otp" placeholder="Mã OTP" required>
                                        </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name='submitregister' class="btn btn-primary btn-lg">Xác nhận</button>
                                        </div>

                                        <div class=" d-flex justify-content-center m-b-3">
                                            <span> <a href="/index.php?controller=home&action=otpcode" id="log">Lấy lại mã OTP</a> </span>
                                        </div>

                                    </form>
                                    <!-- end form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>