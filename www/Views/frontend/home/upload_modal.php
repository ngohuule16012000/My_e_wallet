<!-- upload Modal -->
<form class="d-inline" action="/index.php?controller=home&action=upload" method="POST" enctype="multipart/form-data">
    <div class="modal fade w-500" id="upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uploadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadLabel">Upload CMND</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-row align-items-center mb-4">
                        Bổ sung thông tin CMND cho tài khoản <?php echo $result[0]['fullname'] ; ?>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa fa-cloud-upload fa-lg me-3 fa-fw ml-2"></i>
                        <div class="form-outline flex-fill mb-0">
                            <label for="fontimage" class="form-label">Ảnh mặt trước chứng minh nhân dân</label>
                            <input class="form-control border" id="fontimage" name="fontimage" type="file" required/>
                        </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa fa-cloud-upload fa-lg me-3 ml-2 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <label for="backimage" class="form-label">Ảnh mặt sau chứng minh nhân dân</label>
                            <input class="form-control border" id="backimage" name="backimage" type="file" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="#"><button name="submit" type="submit" class="btn btn-info">Upload</button></a>
                </div>
            </div>
        </div>
    </div>                                    
</form>