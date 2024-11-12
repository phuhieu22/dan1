<?php 

class HomeController
{
    public $modelSanPham;
    public function __construct(){
        $this -> modelSanPham = new sanPham();
    }
    public function index() {
        echo "Xưởng thực hành dự án 1";
    }
    public function trangchu(){
        echo "Trang chủ";
    }

    public function danhsach(){
        // echo "Danh sách";
        $listProducts = $this -> modelSanPham->getAllproducts();
        // var_dump($listProducts);
        require_once './views/danhsachsanpham.php';
    }
}