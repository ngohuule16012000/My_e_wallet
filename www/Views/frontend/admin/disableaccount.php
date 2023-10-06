
<div class="container">
    <div class='row'>
        <div class='col-12 mt-5'>
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                    <th>Họ tên</th>
                    <th>Tài khoản</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                    <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
<?php
    foreach($result as $value)
    {
        $id = $value['id'];
?>
                    <tr>
                    <td>
                        <div class="d-flex align-items-center">
                        <img
                            src="/images/avatar.png"
                            class="rounded-circle"
                            alt=""
                            style="width: 45px; height: 45px"
                            />
                        <div class="ms-3">
                            <p class="fw-bold mb-1"><?= $value['fullname'] ?></p>
                        </div>
                        </div>
                    </td>

                    <td>
                        <p class="fw-normal mt-2"><?= $value['username'] ?></p>
                    </td>
                    
                    <td>
                        <div class="mt-2">
                            <span class="badge badge-danger rounded-pill d-inline text-dark"><?= $value['status'] ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="mt-2">
                            <p class="fw-normal mt-2"><?= date("d-m-Y H:i:s", strtotime($value['date_create']))?></p>
                        </div>
                    </td>

                    <td>
                        <form class="d-inline" method="POST" action="/index.php?controller=admin&action=detail">
                            <input type="hidden" name="id" value="<?= $value['id'] ?>"></input>
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

