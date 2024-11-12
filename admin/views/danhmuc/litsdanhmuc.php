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
                    <h1>Quản lí Danh mục</h1>
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
                            <a href="index.php?act=form-them-danh-muc">
                                <button class="btn btn-success">Thêm danh mục</button>
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
                                        <th>stt</th>
                                        <th>Tên danh mục</th>
                                        <th>Mô Tả</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listDanhMuc as $key => $danhmuc) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $key + 1 ?>
                                        </td>
                                        <td>
                                            <?= $danhmuc["ten_danh_muc"] ?>
                                        </td>
                                        <td>
                                            <?= $danhmuc["mo_ta"] ?>
                                        </td>
                                        <td>
                                            <a href="index.php?act=form-sua-danh-muc&id_danh_muc=<?=$danhmuc["id"]?>">
                                                <button class="btn btn-warning">sửa</button></a>

                                            <a href="index.php?act=xoa-danh-muc&id_danh_muc=<?=$danhmuc["id"]?>"
                                                onclick="return confirm('bạn có chắc chắn xoá không?')">
                                                <button class="btn btn-danger">xoá</button></a>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>stt</th>
                                        <th>Tên danh mục</th>
                                        <th>Mô Tả</th>
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
include './views/layouts/footer.php';?>
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