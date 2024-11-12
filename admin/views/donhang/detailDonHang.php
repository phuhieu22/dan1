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
        <div class="col-sm-10">
          <h1>Quản lí danh sách đơn hàng-Đơn hàng:<?= $donhang["ma_don_hang"] ?></h1>
        </div>

        <!-- <form action="" method="post" class="col-sm-2">
          <select class="form-group">
            <?php foreach ($listTrangThaiDonHang as $key => $trangThai) { ?>
            <option 
              <?= $trangThai['id'] == $donhang['trang_thai_id'] ? 'selected' : '' ?>
              <?= $trangThai['id'] < $donhang['trang_thai_id'] ? 'disabled' : '' ?>
              value="<?= $trangThai['id'] ?>"> <?= $trangThai['ten_trang_thai'] ?> 
            </option>
            <?php } ?>
          </select>
        </form> -->
        <form action="" method="post" class="col-sm-2">
          <select class="form-control" name="trang_thai_id" onchange="this.form.submit()">
            <?php foreach ($listTrangThaiDonHang as $key => $trangThai) { ?>
              <option
                <?= $trangThai['id'] == $donhang['trang_thai_id'] ? 'selected' : '' ?>
                <?= $trangThai['id'] < $donhang['trang_thai_id'] ? 'disabled' : '' ?>
                value="<?= $trangThai['id'] ?>">
                <?= $trangThai['ten_trang_thai'] ?>
              </option>
            <?php } ?>
          </select>
        </form>
      </div>

    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php
          if ($donhang['trang_thai_id'] == 1) {
            $coloAlert = 'primary';
          } elseif ($donhang['trang_thai_id'] >= 2 && $donhang['trang_thai_id'] <= 13) {
            $coloAlert = 'warning';
          } elseif ($donhang['trang_thai_id'] == 14) {
            $coloAlert = 'success';
          } else {
            $coloAlert = 'danger';
          }
          ?>
          <div class="alert alert-<?= $coloAlert ?>" role="alert">
            <h3> Đơn hàng: <?= $donhang['ten_trang_thai']; ?></h3>
          </div>


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> Shop anh hiếu
                  <small class="float-right">Ngày đặt:<?= formatDate($donhang['ngay_dat']) ?></small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Thông tin người đặt
                <address>
                  <strong><?= $donhang['ho_ten'] ?></strong><br>
                  Số Điện Thoại:<?= $donhang['so_dien_thoai'] ?><br>
                  Email: <?= $donhang['email'] ?><br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Người nhận
                <address>
                  <strong><?= $donhang['ten_nguoi_nhan'] ?></strong><br>
                  Địa chỉ:<?= $donhang['dia_chi_nguoi_nhan'] ?> <br>
                  Số điện thoai:<?= $donhang['sdt_nguoi_nhan'] ?><br>
                  Email: <?= $donhang['email_nguoi_nhan'] ?>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Mã đơn hàng:<?= $donhang['ma_don_hang'] ?></b><br>
                <b> Tổng tiền:</b><?= $donhang['tong_tien'] ?><br>
                <b>Ghi chú:</b><?= $donhang['ghi_chu'] ?><br>
                <b> Phương thưc thanh toan::</b> <?= $donhang['ten_phuong_thuc'] ?>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên sản phẩm</th>
                      <th>Đơn giá</th>
                      <th>Số lượng</th>
                      <th>Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tong_tien = 0;
                    foreach ($sanPhamDonHang as $key => $sanPham) { ?>
                      <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $sanPham['ten_san_pham'] ?> </td>
                        <td><?= $sanPham['don_gia'] ?></td>
                        <td><?= $sanPham['so_luong'] ?></td>
                        <td><?= $sanPham['thanh_tien'] ?></td>
                      </tr>
                      <?php $tong_tien += $sanPham['thanh_tien']; ?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <!-- /.col -->
              <div class="col-6">
                <p class="lead">Ngày đặt hàng:<?= formatDate($donhang['ngay_dat'])  ?></p>

                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th style="width:50%">Thành tiền:</th>
                        <td>
                          <?= $tong_tien ?> VNĐ
                        </td>
                      </tr>
                      <tr>
                        <th>Vận chuyển:</th>
                        <td>200.000</td>
                      </tr>
                      <tr>
                        <th>Tổng tiền:</th>
                        <td><?= $tong_tien + 200.000 ?>.000 VNĐ</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                  Payment
                </button>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                  <i class="fas fa-download"></i> Generate PDF
                </button>
              </div>
            </div>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
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