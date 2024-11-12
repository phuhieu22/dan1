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
                <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <a href="index.php?act=form-them-san-pham">
                                <button class="btn btn-success">Thêm sản phẩm</button>
                            </a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['success'])) {
                                echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
                                unset($_SESSION['success']);
                            }

                            // ... other code
                            ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá Sản phẩm</th>
                                        <th>Giá Khuyến mãi</th>
                                        <th>Hình ảnh</th>
                                        <th>Số Lượng</th>
                                        <th>Lượt xem</th>
                                        <th>Ngày nhập</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Tên Danh mục</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listSanPham as $key => $sanpham) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $key + 1 ?>
                                        </td>
                                        <td>
                                            <?= $sanpham["ten_san_pham"] ?>
                                        </td>
                                        <td>
                                            <?= $sanpham["gia_san_pham"] ?>
                                        </td>
                                        <td>
                                            <?= $sanpham["gia_khuyen_mai"] ?>
                                        </td>
                                        <td>
                                            <img style="width: 100px;" src="<?= BASE_URL. $sanpham["hinh_anh"] ?>"
                                                alt="" onerror="this.onerror=null;this.src='./uploads/th.jpg';">
                                        </td>
                                        <td>
                                            <?= $sanpham["so_luong"] ?>
                                        </td>
                                        <td>
                                            <?= $sanpham["luot_xem"] ?>
                                        </td>
                                        <td>
                                            <?= $sanpham["ngay_nhap"] ?>
                                        </td>
                                        <td>
                                            <?= $sanpham["mo_ta"] ?>
                                        </td>
                                        <td>
                                            <?= $sanpham["trang_thai"]==1 ? "Còn hàng" : "Hết hàng" ?>
                                        </td>
                                        <td>
                                            <?= $sanpham["ten_danh_muc"] ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a
                                                    href="index.php?act=form-sua-san-pham&id_san_pham=<?= $sanpham["id"] ?>">
                                                    <button class="btn btn-warning"><i
                                                            class="fas fa-cog"></i></button></a>

                                                <a
                                                    href="index.php?act=chi-tiet-san-pham&id_san_pham=<?= $sanpham["id"] ?>">
                                                    <button class="btn btn-primary"><i
                                                            class="fas fa-eye"></i></button></a>

                                                <a href="index.php?act=xoa-san-pham&id_san_pham=<?= $sanpham["id"] ?>"
                                                    onclick="return confirm('bạn có chắc chắn xoá không?')">
                                                    <button class="btn btn-danger"><i
                                                            class="fas fa-trash"></i></button></a>
                                            </div>


                                        </td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá Sản phẩm</th>
                                        <th>Giá Khuyến mãi</th>
                                        <th>Hình ảnh</th>
                                        <th>Số Lượng</th>
                                        <th>Lượt xem</th>
                                        <th>Ngày nhập</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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
    document.querySelector('input[aria-controls="example1"]').addEventListener('keyup', function(e) {
    const searchValue = e.target.value.toLowerCase();
    const table = document.getElementById('example1');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (let row of rows) {
        const cells = row.getElementsByTagName('td');
        let found = false;
        
        for (let cell of cells) {
            if (cell.textContent.toLowerCase().includes(searchValue)) {
                found = true;
                break;
            }
        }
        
        row.style.display = found ? '' : 'none';
    }
});

</script>
</html>