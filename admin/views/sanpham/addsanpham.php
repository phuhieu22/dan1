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
                    <h1>Thêm Sản Phẩm</h1>
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
                            <h3 class="card-title">Thêm Sản Phẩm</h3>
                        </div>
                        <form action="index.php?act=them-san-pham" method="post" enctype="multipart/form-data">
                            <div class="card-body row">
                                <div class="form-group col-md-12">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm "
                                        name="ten_san_pham">
                                    <?php
                                    if(isset($_SESSION["error"]['ten_san_pham'])){?>
                                    <p class="text-danger"><?=$_SESSION["error"]['ten_san_pham']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Giá sản phẩm</label>
                                    <input type="number" class="form-control" placeholder="Giá sản phẩm "
                                        name="gia_san_pham">
                                    <?php
                                    if(isset($_SESSION["error"]['gia_san_pham'])){?>
                                    <p class="text-danger"><?=$_SESSION["error"]['gia_san_pham']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Giá khuyến mãi sản phẩm</label>
                                    <input type="number" class="form-control" placeholder="Giá khuyến mãi sản phẩm "
                                        name="gia_khuyen_mai">
                                    <?php
                                    if(isset($_SESSION["error"]['gia_khuyen_mai'])){?>
                                    <p class="text-danger"><?=$_SESSION["error"]['gia_khuyen_mai']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="hinh_anh">
                                    <?php
                                    if(isset($_SESSION["error"]['hinh_anh'])){?>
                                    <p class="text-danger"><?=$_SESSION["error"]['hinh_anh']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Abum ảnh</label>
                                    <input type="file" class="form-control" name="img_array[]" multiple>

                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Số lượng sản phẩm</label>
                                    <input type="number" class="form-control" placeholder="Số lượng sản phẩm "
                                        name="so_luong">
                                    <?php
                                    if(isset($_SESSION["error"]['so_luong'])){?>
                                    <p class="text-danger"><?=$_SESSION["error"]['so_luong']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Ngày nhập</label>
                                    <input type="date" class="form-control" placeholder="ngày nhập sản phẩm "
                                        name="ngay_nhap">
                                    <?php
                                    if(isset($_SESSION["error"]['ngay_nhap'])){?>
                                    <p class="text-danger"><?=$_SESSION["error"]['ngay_nhap']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Danh mục</label>
                                    <select name="danh_muc_id" class="form-control">
                                        <option selected disabled>Chọn danh mục sản phẩm</option>
                                        <?php
                                        foreach($listDanhMuc as $danhmuc){
                                            ?>
                                        <option value="<?=$danhmuc['id']?>"><?=$danhmuc['ten_danh_muc']?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <?php
                                    if(isset($_SESSION["error"]['danh_muc_id'])){?>
                                    <p class="text-danger"><?=$_SESSION["error"]['danh_muc_id']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Trạng thái</label>
                                    <select name="trang_thai" class="form-control">
                                        <option selected disabled>Chọn danh mục sản phẩm</option>
                                        <option value="1">Còn hàng</option>
                                        <option value="2">Hết hàng</option>

                                    </select>
                                    <?php
                                    if(isset($_SESSION["error"]['trang_thai'])){?>
                                    <p class="text-danger"><?=$_SESSION["error"]['trang_thai']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-12">
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