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
                    <h1>Thêm Danh mục</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Danh Mục</h3>
                        </div>
                        <form action="index.php?act=form-them-danh-muc" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên danh mục"
                                        name="ten_danh_muc">
                                    <?php
                                    if(isset($errors['ten_danh_muc'])){?>
                                    <p class="text-danger"><?=$errors['ten_danh_muc']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea type="text" class="form-control" placeholder="Nhập mô tả"
                                        name="mo_ta"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="them">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </section>

</div>
<?php
include './views/layouts/footer.php';?>

</body>

</html>