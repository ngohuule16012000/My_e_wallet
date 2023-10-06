<?php
if ($errorupload !== ''){
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
                                <div class="hover-zoom">
                                <img
                                    src="/images/avatar.png"
                                    class="rounded-circle mt-10 "
                                    alt=""
                                    height="100" 
                                    />
                                </div>
                                
                                <div class="mt-3">
                                    <strong class="text-white"><?= $_SESSION['user'] ?></strong>
                                </div>
                                <div class="mt-1">
                                    <strong class="text-white"><?= $_SESSION['name'] ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 mt-5">
                            <div class="card-block mx-5">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Thông tin cá nhân</h6>
                                <div class="row mb-5">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Số điện thoại</p>
                                        <p class="m-b-10 f-w-600">Địa chỉ email</p>
                                        <p class="m-b-10 f-w-600">Họ tên</p>
                                        <p class="m-b-10 f-w-600">Ngày sinh</p>
                                        <p class="m-b-10 f-w-600">Địa chỉ</p>
                                        <p class="m-b-10 f-w-600">Số dư</p>
                                        <p class="m-b-10 f-w-600">Trạng thái</p>
                                        <?php
                                        if ($error !== '')
                                        {
                                            echo '<p class="m-b-10 f-w-600">Require</p>';
                                            echo '<p class="m-b-10 f-w-600"></p>';
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-6">
                                    <?php
                                        // foreach($result as $value)
                                    ?>
                                        <p class="m-b-10 text-muted f-w-400"><?= $result[0]['phone'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $result[0]['email'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $result[0]['fullname'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= date("d-m-Y", strtotime($result[0]['date'])) ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $result[0]['address'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400">
                                            <?php 
                                                if ($result[0]['account_balance'] != 0)
                                                    echo currency_format($result[0]['account_balance']); 
                                                else
                                                    echo '0đ';
                                            ?>
                                        </p>
                                        <p class="m-b-10 text-muted f-w-400">
                                        <?php
                                        if($result[0]['status'] == 'đã xác minh') 
                                        {
                                            echo '<strong class="text-success">' . $result[0]['status'] . '</strong>';
                                        }
                                        else
                                        {
                                            echo '<strong class="text-danger">' . $result[0]['status'] . '</strong>';
                                        }
                                        ?>
                                        </p>
                                        <?php
                                        if ($error !== '')
                                        {
                                            echo '<strong class="m-b-10 f-w-400 text-warning"> '. $error . '</strong>';
                                            echo '<p class="m-b-10 f-w-400 text-muted"><a href=""  data-bs-toggle="modal" data-bs-target="#upload">bổ sung tại đây</a></p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>



