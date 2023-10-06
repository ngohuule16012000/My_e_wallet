<?php
    // echo '<pre>';
    // print_r($transhis);
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
                                    src="/images/icons8-deposit-64.png"
                                    class="rounded-circle mt-10"
                                    alt=""
                                    height = "100"/>
                            </div>
                        </div>
                        <div class="col-sm-8 mt-5">
                            <div class="card-block mx-5">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Thông tin chuyển tiền</h6>
                                <div class="row mb-5">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Mã giao dịch</p>
                                        <p class="m-b-10 f-w-600">Tài khoản gửi tiền</p>
                                        <p class="m-b-10 f-w-600">Tài khoản nhận tiền</p>
                                        <p class="m-b-10 f-w-600">Trạng thái</p>
                                        <p class="m-b-10 f-w-600">Phí giao dịch</p>
                                        <p class="m-b-10 f-w-600">Số tiền gửi</p>
                                        <p class="m-b-10 f-w-600">Lời nhắn chuyển tiền</p>
                                        <p class="m-b-10 f-w-600">Thời gian thực hiện</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 text-muted f-w-400"><?= $transhis['id'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $_SESSION['sender_id'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $_SESSION['receiver_id'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?php echo '<strong class="text-warning">' . $transhis['status'] . '</strong>'; ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= currency_format($transhis['fee']) ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= currency_format($transhis['money']) ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= $transhis['note'] ?></p>
                                        <p class="m-b-10 text-muted f-w-400"><?= date("d-m-Y H:i:s", strtotime($transhis['trans_date'])) ?></p>
                                    </div>
                                </div>
                                <ul class="social-link list-unstyled mb-5">
                                    <span><a href="#"><i class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#approve">Duyệt</i></a></span>
                                    <span><a href="#"><i class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#inapprove">Huỷ</i></a></span>
                                </ul>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>



