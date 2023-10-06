<?php
    foreach($result as $value)
?>
<div class="page-content page-container my-5">
    <div class="container d-flex justify-content-center ">
        <div class="col-xl-12 col-md-12">
            <div class="card user-card-full ">
                <div class="row">
                    <div class="col-sm-4  bg-secondary">
                        <div class="h-50"></div>
                        <div class="text-center">
                            <div class="hover-zoom">
                            <img
                                src="/images/avatar.png"
                                class="rounded-circle mt-10"
                                alt=""
                                height = "100"/>
                            </div>
                            
                            <div class="mt-3">
                                <strong class="text-white"><?= $value['username'] ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 mt-5">
                        <div class="card-block mx-5">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Thông tin tài khoản</h6>
                            <div class="row mb-5">
                                <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Số điện thoại</p>
                                    <p class="m-b-10 f-w-600">Địa chỉ email</p>
                                    <p class="m-b-10 f-w-600">Họ tên</p>
                                    <p class="m-b-10 f-w-600">Ngày sinh</p>
                                    <p class="m-b-10 f-w-600">Địa chỉ</p>
                                    <p class="m-b-10 f-w-600">Số dư</p>
                                    <p class="m-b-10 f-w-600">Trạng thái</p>
                                </div>
                                <div class="col-sm-6">
                                
                                    <p class="m-b-10 text-muted f-w-400"><?= $value['phone'] ?></p>
                                    <p class="m-b-10 text-muted f-w-400"><?= $value['email'] ?></p>
                                    <p class="m-b-10 text-muted f-w-400"><?= $value['fullname'] ?></p>
                                    <p class="m-b-10 text-muted f-w-400"><?= date("d-m-Y", strtotime($value['date'])) ?></p>
                                    <p class="m-b-10 text-muted f-w-400"><?= $value['address'] ?></p>
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
                                    if($value['status'] === 'chờ xác minh') {
                                        echo '<strong class="text-warning">' . $value['status'] . '</strong>';
                                    }
                                    else if($value['status'] === 'đã xác minh')
                                    {
                                        echo '<strong class="text-success">' . $value['status'] . '</strong>';
                                    }
                                    else
                                    {
                                        echo '<strong class="text-danger">' . $value['status'] . '</strong>';
                                    } ?>
                                    </p>
                                </div>

                                

                                <table class="col-sm-12">
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-6"><p class="m-b-10 f-w-600 ml-2">Mặt trước CMND</p></td>
                                            <td class="bg-image hover-zoom">
                                                
                                                <img src="/public/upload/<?= $value['fontimage'] ?>" class="rounded col-sm-6" data-bs-toggle="modal" data-bs-target="#fontimageModal">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-6"><p class="m-b-10 f-w-600 ml-2">Mặt sau CMND</p></td>
                                            <td class="bg-image hover-zoom">
                                                <img src="/public/upload/<?= $value['backimage'] ?>" class="rounded col-sm-6" data-bs-toggle="modal" data-bs-target="#backimageModal">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <?php
                            if($value['lockaccount'] == 0)
                            {
                                echo '<ul class="social-link list-unstyled mb-5">
                                <span><a href="#"><i class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#confirm">Xác minh</i></a></span>
                                <span><a href="#"><i class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#disable">Huỷ</i></a></span>
                                <span><a href="#"><i class="btn btn-info mx-2" data-bs-toggle="modal" data-bs-target="#requireinfo">Yêu cầu bổ sung thông tin</i></a></span>
                            </ul>';
                            }
                            else
                            {
                                echo '<ul class="social-link list-unstyled mb-5">
                                <span><a href="#"><i class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#openlock">Mở khóa</i></a></span>
                                </ul>';
                            }
                            ?>

                            <!-- Lịch sử giao dịch -->
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom">Lịch sử giao dịch</h6>
                            <div class='row mb-5'>
                                <div class='col-12 mt-5'>
                                    <table class="table align-middle mb-0 bg-white">
                                        <thead class="bg-light">
                                            <tr>
                                            <th>STT</th>
                                            <th>Số tiền</th>
                                            <th>Loại giao dịch</th>
                                            <th>Trạng thái</th>
                                            <th>Thời gian</th>
                                            <th>Chi phí</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($transhis as $trans){
                                            ?>
                                            <tr>
                                            <td>
                                                <p class="fw-normal mt-2">1</p>
                                            </td>

                                            <td>
                                                <p class="fw-normal mt-2"><?= currency_format($trans['money']); ?></p>
                                            </td>

                                            <td>
                                                <?php
                                                if($trans['type'] == 0)
                                                {
                                                    echo '<p class="fw-normal mt-2">Nạp tiền</p>';
                                                }
                                                else if($trans['type'] == 1)
                                                {
                                                    echo '<p class="fw-normal mt-2">Rút tiền</p>';
                                                }
                                                else if($trans['type'] == 2)
                                                {
                                                    echo '<p class="fw-normal mt-2">Chuyển tiền</p>';
                                                }
                                                else if($trans['type'] == 3)
                                                {
                                                    echo '<p class="fw-normal mt-2">Nhận tiền</p>';
                                                }
                                                else
                                                {
                                                    echo '<p class="fw-normal mt-2">Mua thẻ điện thoại</p>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                            <?php
                                                if($trans['status'] == '')
                                                {
                                                    echo '<p class="fw-normal mt-2">Hoàn thành</p>';
                                                }
                                                else
                                                {
                                                    echo '<p class="fw-normal mt-2">' . $trans['status'] . '</p>';
                                                }
                                                ?>
                                                
                                            </td>
                                            
                                            <td>
                                                <p class="fw-normal mt-2"><?= date("d-m-Y H:i:s", strtotime($trans['trans_date'])) ?></p>
                                            </td>
                                            <td>
                                                <?php
                                                if($trans['fee'] == '')
                                                {
                                                    echo '<p class="fw-normal mt-2">0 đ</p>';
                                                }
                                                else
                                                {
                                                    echo '<p class="fw-normal mt-2">' . currency_format($trans['fee']) . '</p>';
                                                }
                                                ?>
                                            </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

