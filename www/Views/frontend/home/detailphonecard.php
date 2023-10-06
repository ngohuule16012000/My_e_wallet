<?php
    // echo '<pre>';
    // print_r($result);
?>

<div class="page-content page-container my-5">
        <div class="container d-flex justify-content-center ">
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full ">
                    <div class="row">
                        <div class="col-sm-4  bg-success">
                            <div class="h-50"></div>
                            <div class="text-center">
                                <img
                                    src="/images/avatar.png"
                                    class="rounded-circle mt-10 image-avatar"
                                    alt=""
                                    height="100" 
                                    />
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
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Thông tin mua thẻ điện thoại</h6>
                                <div class="row mb-5">
                                    <div class="col-sm-6">
                                        <p class="mb-4 f-w-600">Mã giao dịch</p>
                                        <p class="mb-4 f-w-600">Trạng thái</p>
                                        <p class="mb-4 f-w-600">Phí giao dịch</p>
                                        <p class="mb-4 f-w-600">Số tiền</p>
                                        <p class="mb-4 f-w-600">Thời gian thực hiện</p>
                                        <p class="mb-4 f-w-600">Nhà mạng</p>
                                        <p class="mb-4 f-w-600">Mệnh giá thẻ cào</p>
                                        <p class="mb-4 f-w-600">Số lượng thẻ cào</p>
                                        <?php
                                            $codes=  explode(" ", $result['cardcode']);
                                            $count = count($codes);
                                        ?>
                                        <p class="mb-4 f-w-600">Mã thẻ cào</p>
                                        <?php
                                            if($count > 1){
                                                for($i = 1; $i < $count-1; $i++)
                                                {
                                                    echo '<p hidden class="mb-4 f-w-600">a</p>';
                                                }
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="mb-4 text-muted f-w-400"><?= $result['id'] ?></p>
                                        <p class="mb-4 text-muted f-w-400">Hoàn thành</p>
                                        <p class="mb-4 text-muted f-w-400"><?php if($result['fee'] != '') currency_format($result['fee']); else echo 0 . " đ"; ?></p>
                                        <p class="mb-4 text-muted f-w-400"><?= currency_format($result['money']) ?></p>
                                        <p class="mb-4 text-muted f-w-400"><?= $result['trans_date'] ?></p>
                                        <p class="mb-4 text-muted f-w-400"><?= $result['home'] ?></p>
                                        <p class="mb-4 text-muted f-w-400"><?= currency_format($result['valuecard']) ?></p>
                                        <p class="mb-4 text-muted f-w-400"><?= $result['quantity'] ?></p>
                                        <p class="mb-4 text-muted f-w-400"><?= $codes[0] ?></p>
                                        <?php
                                            if($count > 1){
                                                for($i = 1; $i < $count-1; $i++)
                                                {
                                                    echo '<p class="mb-4 text-muted f-w-400">' . $codes[$i] . '</p>';
                                                }
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



