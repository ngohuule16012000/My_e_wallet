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
                                <h5 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Mua thẻ điện thoại</h5>
                                <div class="row mb-5 mr-4">
                                    
                                    <!-- form -->
                                    <form class="mx-1 mx-md-4" action="/index.php?controller=home&action=phonecardcheck" method="post" enctype="multipart/form-data">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="home">Các nhà mạng</label>
                                            <select class="form-control border" id="home" name="home">
                                                <option value="Viettel" selected>Viettel</option>
                                                <option value="Mobifone">Mobifone</option>
                                                <option value="Vinaphone">Vinaphone</option>
                                            </select>
                                        </div>
                                        </div>

                                        <!-- <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="fee">Phí giao dịch</label>
                                            <input type="number" id="fee" class="form-control border" name="fee" placeholder="Phí giao dịch" value="0" readonly/>
                                        </div>
                                        </div> -->

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="money">Chọn mệnh giá nạp</label>
                                            <select class="form-control border" id="money" name="money">
                                                <option value="10000" selected><?= currency_format(10000) ?></option>
                                                <option value="20000"><?= currency_format(20000) ?></option>
                                                <option value="50000"><?= currency_format(50000) ?></option>
                                                <option value="100000"><?= currency_format(100000) ?></option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-6">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="quantity">Số lượng thẻ</label>
                                            <input type="number" id="quantity" class="form-control border" name="quantity" value="1" max="5"/>
                                        </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name='submitregister' class="btn btn-primary btn-lg">Mua thẻ ngay</button>
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