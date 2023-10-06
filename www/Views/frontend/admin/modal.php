
<!-- Confirm Modal -->
<div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmLabel">Xác minh tài khoản</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Bạn muốn <strong class="text-success">xác minh</strong> tài khoản <strong><?= $result[0]['fullname'] ?></strong>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="/index.php?controller=admin&action=confirm"><button class="btn btn-primary">Confirm</button></a>
      </div>
    </div>
  </div>
</div>

<!-- disable Modal -->
<div class="modal fade" id="disable" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="disableLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="disableLabel">Vô hiệu hoá tài khoản</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Bạn muốn <strong class="text-danger">vô hiệu hoá</strong> tài khoản <strong><?= $result[0]['fullname'] ?></strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="/index.php?controller=admin&action=disable"><button class="btn btn-danger">Disable</button></a>
      </div>
    </div>
  </div>
</div>

<!-- info Modal -->
<div class="modal fade w-500" id="requireinfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requireinfoLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="requireinfoLabel">Yêu cầu bổ sung</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Yêu cầu <strong class="text-success">bổ sung thông tin ảnh hai mặt CMND</strong> cho tài khoản <strong><?= $result[0]['fullname'] ?></strong>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="/index.php?controller=admin&action=requireinfo"><button class="btn btn-info">Require</button></a>
        </div>
      </div>
    </div>
</div>

<!-- openlock Modal -->
<div class="modal fade w-500" id="openlock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="openlockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="openlockLabel">Mở khoá tài khoản</h5>
              <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Bạn muốn <strong class="text-success">mở khoá</strong> cho tài khoản <strong><?= $result[0]['fullname'] ?></strong>
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <a href="/index.php?controller=admin&action=openlock"><button class="btn btn-danger">Yes</button></a>
          </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade w-500" id="approve" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="approveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="approveLabel">Phê duyệt giao dịch</h5>
              <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Bạn <strong class="text-success">đồng ý</strong> giao dịch này
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <a href="/index.php?controller=admin&action=transapprove"><button class="btn btn-danger">Yes</button></a>
          </div>
        </div>
    </div>
</div>

<!-- Inapprove Modal -->
<div class="modal fade w-500" id="inapprove" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inapproveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="inapproveLabel">Phê duyệt giao dịch</h5>
              <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Bạn muốn <strong class="text-danger">huỷ</strong> giao dịch này
          </div>
          <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <a href="/index.php?controller=admin&action=transinapprove"><button class="btn btn-danger">Yes</button></a>
          </div>
        </div>
    </div>
</div>

<!-- Font Image Modal -->
<div class="modal fade bd-example-modal-lg" id="fontimageModal" tabindex="-1" role="dialog" aria-labelledby="fontimageModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="fontimageModalTitle">Image</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="/public/upload/<?= $result[0]['fontimage'] ?>" class="rounded mx-auto d-block col-12">
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Back Image Modal -->
<div class="modal fade bd-example-modal-lg" id="backimageModal" tabindex="-1" role="dialog" aria-labelledby="backimageModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="backimageModalTitle">Image</h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="/public/upload/<?= $result[0]['backimage'] ?>" class="rounded mx-auto d-block col-12">
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>