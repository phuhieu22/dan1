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
                <div class="col-sm-6">
                    <h1>Quản lí sản phẩm</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img src="<?= BASE_URL . $sanpham["hinh_anh"] ?>" style="width: 200px; height: 200px;"
                                class="product-image" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            <!-- <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg"
                                    alt="Product Image"></div> -->

                            <?php
                            foreach ($listAnhSanPham as $key => $anhSP) { ?>

                                <div class="product-image-thumb <?= $anhSP[$key] == 0 ? "active" : "" ?>"><img
                                        src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image">
                                </div>

                            <?php }
                            ?>


                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">Tên sản phẩm:
                        <?= $sanpham['ten_san_pham'] ?>
                    </h3>
                    <hr>
                    <h4 class="mt-3">Giá tiền : <small style="color:red;"><?= $sanpham["gia_san_pham"] ?></small></h4>
                    <h4 class="mt-3">Giá khuyến mãi : <small style="color:red;"><?= $sanpham["gia_khuyen_mai"] ?></small>
                    </h4>
                    <h4 class="mt-3">Số Lượng : <small style="color:red;"><?= $sanpham["so_luong"] ?></small></h4>
                    <h4 class="mt-3">Lượt xem : <small style="color:red;"><?= $sanpham["luot_xem"] ?></small></h4>
                    <h4 class="mt-3">Ngày nhập : <small style="color:red;"><?= $sanpham["ngay_nhap"] ?></small></h4>
                    <h4 class="mt-3">Danh mục : <small style="color:red;"><?= $sanpham["ten_danh_muc"] ?></small></h4>
                    <h4 class="mt-3">Trạng thái : <small
                            style="color:red;"><?= $sanpham["trang_thai"] == 1  ? "Còn hàng" : "Hết hàng" ?></small>
                    </h4>
                    <h4 class="mt-3">Mô tả : <small style="color:red;"><?= $sanpham["mo_ta"] ?></small></h4>


                </div>
            </div>
            <ul class="nav nav-tabs row mt-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Bình luận sản phẩm</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên người bình luận</th>
                                        <th>Nội dung</th>
                                        <th>Ngày đăng</th>
                                        <th>Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>ANH hiếu</td>
                                        <td>chó lười ăn</td>
                                        <td>30/4/2024</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#"><button class="btn btn-warning">Ẩn</button></a>
                                                <a href="#"><button class="btn btn-danger">Xoá</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>ANH hiếu dz</td>
                                        <td>chó lười ăn</td>
                                        <td>30/4/2024</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#"><button class="btn btn-warning">Ẩn</button></a>
                                                <a href="#"><button class="btn btn-danger">Xoá</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
               
            </div>
        </div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<?php
include './views/layouts/footer.php'; ?>
</body>
<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>

</html>