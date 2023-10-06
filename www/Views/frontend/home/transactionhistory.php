<?php
    foreach($result as $value)
?>
<div class="page-content page-container my-5">
    <div class="container d-flex justify-content-center ">
        <div class="col-xl-12 col-md-12">
            <div class="card user-card-full ">
                <div class="row">
                    <div class="col-sm-12 rounded-top">
                        <div class="col-sm-12 rounded-top bg-success">
                            <div class="text-center mt-10 h-100">
                                <div class="pt-10 hover-zoom">
                                <img
                                    src="/images/icons8-deposit-64.png"
                                    class="rounded-circle mt-10"
                                    alt=""
                                    height = "100"/>
                                </div>
                                
                                <div class="mt-3">
                                    <strong class="text-white"><?= $_SESSION['user'] ?></strong>
                                </div>
                                <div class="mt-2">
                                    <strong class="text-white"><?= $_SESSION['name'] ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="card-block mx-5 mt-5">
                            <!-- Lịch sử giao dịch -->
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600 border-bottom">Lịch sử giao dịch</h6>
                            <div class='row mb-5'>
                                <div class='col-12 mt-5'>
                                    <table class="table table-hover align-middle mb-0 bg-white">
                                        <thead class="bg-light">
                                            <tr>
                                            <th>STT</th>
                                            <th>Loại giao dịch</th>
                                            <th>Số tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Thời gian thực hiện</th>
                                            <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                foreach($transhis as $trans){
                                            ?>
                                            <tr>
                                            <td>
                                                <p class="fw-normal mt-2"><?= $i++ ?></p>
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
                                                <p class="fw-normal mt-2"><?= currency_format($trans['money']); ?></p>
                                            </td>
                                            <td>
                                            <?php
                                                if($trans['status'] == '')
                                                {
                                                    echo '<span class="badge badge-success rounded-pill d-inline text-dark">Hoàn thành</span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="badge badge-warning rounded-pill d-inline text-dark">' . $trans['status'] . '</warning>';
                                                }
                                                ?>
                                                
                                            </td>
                                            
                                            <td>
                                                <p class="fw-normal mt-2"><?= date("d-m-Y H:i:s", strtotime($trans['trans_date'])) ?></p>
                                            </td>
                                            <td>
                                                <form class="d-inline" method="POST" action="/index.php?controller=home&action=detail">
                                                    <input type="hidden" name="id" value="<?= $trans['id'] ?>"></input>
                                                    <button
                                                            type="submit"
                                                            class="btn btn-link btn-rounded btn-sm fw-bold"
                                                            data-mdb-ripple-color="dark"
                                                            >
                                                    View
                                                    </button>
                                                    
                                                </form>
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

