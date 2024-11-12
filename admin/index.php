<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/adminSanPhamController.php';
require_once './controllers/adminDanhMucController.php';
require_once './controllers/adminDonHangController.php';

// Require toàn bộ file Models
require_once './models/adminSanPham.php';
require_once './models/adminDanhmuc.php';
require_once './models/adminDonHang.php';




// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    //route danh muc
    'danhmuc'=> (new DanhmucController())->danhmuc(),
    'form-them-danh-muc'=> (new DanhmucController())->formAdddDanhMuc(),
    // 'them-danh-muc'=> (new DanhmucController())->possAddDanhmuc(),
    
    'form-sua-danh-muc'=> (new DanhmucController())->formEditDanhMuc(), 
    'sua-danh-muc'=> (new DanhmucController())->possEditDanhmuc(),
    'xoa-danh-muc'=>(new DanhmucController())->deleteDanhMuc(),

    
    //route san pham
    'sanpham' => (new sanPhamController())-> sanpham(),
    'form-them-san-pham'=> (new sanPhamController())->formAddSanPham(),
    'them-san-pham'=> (new sanPhamController())->possAddSanPham(),
    'form-sua-san-pham'=> (new sanPhamController())->formEditSanPham(), 
    'sua-san-pham'=> (new sanPhamController())->possEditSanPham(),
    'sua-album-anh-san-pham'=>(new sanPhamController())->possEditAnhSanPham(),
    'xoa-san-pham'=>(new sanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham'=>(new sanPhamController())->detaiSanPham(),


    //route đơn hàng
    'don-hang' => (new donHangController())-> danhSachDonHang(),
    // 'form-sua-don-hang'=> (new donHangController())->formEditdonHang(), 
    // 'sua-don-hang'=> (new donHangController())->possEditdonHang(),
    // 'xoa-don-hang'=>(new donHangController())->deletedonHang(),
    'chi-tiet-don-hang'=>(new donHangController())->detaildonHang(),




};