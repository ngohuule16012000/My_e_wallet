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
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Thông tin nhận tiền</h6>
                                <div class="row mb-5">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Mã giao dịch</p>
                                        <p class="m-b-10 f-w-600">Trạng thái</p>
                                        <p class="m-b-10 f-w-600">Phí giao dịch</p>
                                        <p class="m-b-10 f-w-600">Số tiền nhận</p>
                                        <p class="m-b-10 f-w-600">Tài khoản gửi tiền</p>
                                        <p class="m-b-10 f-w-600">Tên người gửi tiền</p>
                                        <p class="m-b-10 f-w-600">Lời nhắn chuyển tiền</p>
                                        <p class="m-b-10 f-w-600">Thời gian thực hiện</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 text-muted f-w-400"><?= $result['id'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400">Hoàn thành</p>
                                        <p class="m-b-10 text-muted f-w-400"><?php if($result['fee'] != '') currency_format($result['fee']); else echo 0 . " đ"; ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= currency_format($result['money']) ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $_SESSION['sender_id'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $_SESSION['sender_name'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $result['note'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $result['trans_date'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>



