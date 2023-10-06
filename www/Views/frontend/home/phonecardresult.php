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
                                <h5 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Kết quả giao dịch</h5>
                                <div class="row mb-5 mr-4">
                                    
                                    <!-- form -->
                                    <form class="mx-1 mx-md-4" action="/index.php?controller=home&action=phonecard" method="post" enctype="multipart/form-data">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="home">Nhà mạng</label>
                                            <input class="form-control bg-light" id="home" name="home" value="<?= $home ?>" readonly/>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="fee">Phí giao dịch</label>
                                            <input type="text" id="fee" class="form-control bg-light" name="fee" value="<?php if($fee > 0) currency_format($fee); else echo 0 . ' đ'; ?>" readonly/>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="money">Mệnh giá nạp</label>
                                            <input type="text" class="form-control bg-light" id="money" name="money" value="<?= currency_format($money) ?>" readonly/>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-6">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="quantity">Số lượng thẻ</label>
                                            <input type="number" id="quantity" class="form-control bg-light" name="quantity" value="<?= $quantity ?>" readonly/>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-6">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="code">Mã điện thoại</label>
                                            <?php
                                                foreach($cardcode as $code)
                                                {
                                                    echo '<input type="number" class="form-control bg-light" value="' . $code . '" readonly/>';
                                                }
                                            ?>
                                            
                                        </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name='submitregister' class="btn btn-primary btn-lg">Mua thẻ mới</button>
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