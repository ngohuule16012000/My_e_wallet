<?php
    // echo '<pre>';
    // print_r($transhis);
?>
<div class="container">
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
                        <div class="mt-2">
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
                        </div>
                    </td>
                    
                    <td>
                        <p class="fw-normal mt-2"><?= date("d-m-Y H:i:s", strtotime($trans['trans_date'])) ?></p>
                    </td>
                    <td>
                        <form class="d-inline" method="POST" action="/index.php?controller=admin&action=transdetail">
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

