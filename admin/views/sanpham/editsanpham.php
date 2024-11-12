<!-- Navbar -->

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php
include './views/layouts/header.php';
include './views/layouts/navbar.php';
include './views/layouts/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1>Sửa Sản Phẩm:<b><?= $sanpham["ten_san_pham"] ?></b> </h1>
                </div>
                <div class="col-sm-1">
                    <a href="<?= BASE_URL_ADMIN . '?act=sanpham' ?>" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin sản phẩm</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-san-pham' ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="san_pham_id" value="<?= $sanpham['id'] ?>">
                                <label for="inputName">Tên sản phẩm</label>
                                <input type="text" name="ten_san_pham" class="form-control"
                                    value="<?= $sanpham['ten_san_pham'] ?>">
                                <?php
                                if (isset($_SESSION["error"]['ten_san_pham'])) { ?>
                                <p class="text-danger"><?= $_SESSION["error"]['ten_san_pham'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group  ">
                                <label>Giá sản phẩm</label>
                                <input type="number" class="form-control" name=" gia_san_pham"
                                    value="<?= $sanpham['gia_san_pham'] ?>">
                                <?php
                                if (isset($_SESSION["error"]['gia_san_pham'])) { ?>
                                <p class="text-danger"><?= $_SESSION["error"]['gia_san_pham'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group  ">
                                <label>Giá khuyến mãi sản phẩm</label>
                                <input type="number" class="form-control" name="gia_khuyen_mai"
                                    value="<?= $sanpham['gia_khuyen_mai'] ?>">
                                <?php
                                if (isset($_SESSION["error"]['gia_khuyen_mai'])) { ?>
                                <p class="text-danger"><?= $_SESSION["error"]['gia_khuyen_mai'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group  ">
                                <label>Hình ảnh sản phẩm</label>
                                <input type="file" class="form-control" name="hinh_anh">

                            </div>
                            <div class="form-group  ">
                                <label>Số lượng sản phẩm</label>
                                <input type="number" class="form-control" name="so_luong"
                                    value="<?= $sanpham['so_luong'] ?>">
                                <?php
                                if (isset($_SESSION["error"]['so_luong'])) { ?>
                                <p class="text-danger"><?= $_SESSION["error"]['so_luong'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group  ">
                                <label>Ngày nhập</label>
                                <input type="date" class="form-control" name="ngay_nhap">
                                <?php
                                if (isset($_SESSION["error"]['ngay_nhap'])) { ?>
                                <p class="text-danger"><?= $_SESSION["error"]['ngay_nhap'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group  ">
                                <label>Danh mục</label>
                                <select name="danh_muc_id" class="form-control">

                                    <?php
                                    foreach ($listDanhMuc as $danhmuc) {
                                    ?>
                                    <option <?= $danhmuc['id'] == $sanpham['danh_muc_id'] ? 'selected' : '' ?>
                                        value="<?= $danhmuc['id'] ?>">
                                        <?= $danhmuc['ten_danh_muc'] ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <?php
                                if (isset($_SESSION["error"]['danh_muc_id'])) { ?>
                                <p class="text-danger"><?= $_SESSION["error"]['danh_muc_id'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group  ">
                                <label>Trạng thái</label>
                                <select name="trang_thai" class="form-control">
                                    <option selected disabled>Chọn danh mục sản phẩm</option>
                                    <option <?= $sanpham["trang_thai"] == 1 ? 'selected' : '' ?> value="1">Còn hàng
                                    </option>
                                    <option <?= $sanpham["trang_thai"] == 2 ? 'selected' : '' ?> value="2">Hết hàng
                                    </option>
                                </select>
                                <?php
                                if (isset($_SESSION["error"]['trang_thai'])) { ?> <p class="text-danger">
                                    <?= $_SESSION["error"]['trang_thai'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Mô tả</label>
                                <textarea type="text" class="form-control"
                                    name="mo_ta"><?= $sanpham['mo_ta'] ?></textarea>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                        </div>

                    </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-4">

                <!-- /.card -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Ảnh sản phẩm</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">

                        <form action="<?= BASE_URL_ADMIN . '?act=sua-album-anh-san-pham' ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="table-responsive">
                                <table id="faqs" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ảnh</th>
                                            <th>file</th>
                                            <th>
                                                <div class="text-center"><button onclick="addfaqs();" type="button"
                                                        class="badge badge-success"><i class="fa fa-plus"></i> thêm
                                                    </button></div>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" name="san_pham_id" value="<?=$sanpham['id']?>">
                                        <input type="hidden" name="img_delete" id="img_delete">
                                        <?php
                                            foreach($listAnhSanPham as $key => $value){ ?>
                                        <tr id="faqs-row-<?= $key ?>">
                                            <input type="hidden" name="current_img_ids[]" value="<?= $value['id'] ?>">
                                            <td><img src="<?=BASE_URL. $value['link_hinh_anh'] ?>"
                                                    style="width: 100px; height:100px " alt="">
                                            </td>
                                            <td><input type="file" name="img_array[]" class=" form-control">
                                            </td>
                                            <td class="mt-10"><button class="badge badge-danger" type="button"
                                                    onclick="removeRow(<?=$key?>,<?=$value['id']?>)"><i
                                                        class="fa fa-trash"></i>
                                                    Delete</button>
                                            </td>
                                            <?php }?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                    </div>

                    <!-- /.card-body -->

                    <div class=" card-footer text-center">
                        <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
</div>
<?php
include './views/layouts/footer.php'; ?>

</body>
<script>
var faqs_row = <?=count($listAnhSanPham) ?>;


function addfaqs() {
    html = '<tr id="faqs-row-' + faqs_row + '">';
    html += '<td><img src="./uploads/th.jpg"  style="width: 100px; height:100px " alt=""></td>';
    html += '<td><input type="file" name="img_array[]"  class="form-control"></td>';
    html +=
        '<td class="mt-10"><button type="button" class="badge badge-danger" onclick="removeRow(' +
        faqs_row + ', null);"><i class="fa fa-trash"></i> Delete</button></td>';

    html += '</tr>';

    $('#faqs tbody').append(html);

    faqs_row++;
}

function removeRow(rowId, imgId) {
    $('#faqs-row-' + rowId).remove();
    if (imgId != null) {
        var imgDeleteInput = document.getElementById('img_delete');
        var currentValue = imgDeleteInput.value;
        imgDeleteInput.value = currentValue ? currentValue + ',' + imgId : imgId;
    }
}
</script>

</html>