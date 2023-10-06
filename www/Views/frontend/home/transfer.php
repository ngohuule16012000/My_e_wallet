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
                                <h5 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom mb-4">Thông tin người nhận tiền</h5>
                                <div class="row mb-5 mr-4">
                                    
                                    <!-- form -->
                                    <form class="mx-1 mx-md-4" action="/index.php?controller=home&action=otpcode" method="post" enctype="multipart/form-data">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="phone">Số điện thoại người nhận</label>
                                            <input type="tel" pattern="^\d{10}$" id="phone" class="form-control bg-light" name="phone" value="<?= $_SESSION['phone_transfer'] ?>" readonly/>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="money">Số tiền</label>
                                            <input type="text" id="money" class="form-control bg-light" name="money" value="<?= currency_format($_SESSION['money_transfer']); ?>" readonly/>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="fullname">Tên người nhận</label>
                                            <input type="text" id="fullname" class="form-control bg-light" name="fullname" value="<?= $_SESSION['name_transfer'] ?>" readonly/>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="fee">Phí chuyển tiền</label>
                                            <input type="text" id="fee" class="form-control bg-light" name="fee" value="<?= currency_format($_SESSION['fee_transfer']); ?>" readonly/>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="party">Bên chịu phí chuyển tiền</label>
                                            <select class="form-control border" id="party" name="party">
                                                <option value="sender" selected>Bên người gửi</option>
                                                <option value="receiver">Bên người nhận</option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-6">
                                        <div class=" form-group form-outline flex-fill mb-0 ">
                                            <label class="font-weight-bold" for="note">Ghi chú</label>
                                            <textarea id="note" class="form-control bg-light" name="note" rows="3" value="<?= $_SESSION['note_transfer'] ?>" readonly><?= $_SESSION['note_transfer'] ?></textarea>
                                        </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name='submitregister' class="btn btn-primary btn-lg">Xác nhận</button>
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