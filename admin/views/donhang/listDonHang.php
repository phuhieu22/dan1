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
                    <h1>Quản lí danh sách đơn hàng </h1>
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
                                        <th>Mã Đơn Hàng</th>
                                        <th>Tên Người Nhận</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Ngày đặt</th>
                                        <th>Tống tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Ghi Chú</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listDonHang as $key => $donHang) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $key + 1 ?>
                                        </td>
                                        <td>
                                            <?= $donHang["ma_don_hang"] ?>
                                        </td>
                                        <td>
                                            <?= $donHang["ten_nguoi_nhan"] ?>
                                        </td>
                                        <td>
                                            <?= $donHang["sdt_nguoi_nhan"] ?>
                                        </td>
                                       
                                        <td>
                                            <?= $donHang["ngay_dat"] ?>
                                        </td>
                                        <td>
                                            <?= $donHang["tong_tien"] ?>
                                        </td>
                                        <td>
                                            <?= $donHang["ten_trang_thai"] ?>
                                        </td>
                                        <td>
                                            <?= $donHang["ghi_chu"] ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a
                                                    href="index.php?act=form-sua-don-hang&id_don_hang=<?= $donHang["id"] ?>">
                                                    <button class="btn btn-warning"><i
                                                            class="fas fa-cog"></i></button></a>

                                                <a
                                                    href="index.php?act=chi-tiet-don-hang&id_don_hang=<?= $donHang["id"] ?>">
                                                    <button class="btn btn-primary"><i
                                                            class="fas fa-eye"></i></button></a>

                                               
                                            </div>


                                        </td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>STT</th>
                                        <th>Mã Đơn Hàng</th>
                                        <th>Tên Người Nhận</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Ngày đặt</th>
                                        <th>Tống tiền</th>
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