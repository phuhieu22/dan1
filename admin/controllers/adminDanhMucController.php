<?php
class DanhmucController {
    public $modelDanhMuc;
    
    public function __construct(){
        $this-> modelDanhMuc = new adminDanhmuc();
    }
    
    public function danhmuc() {
        // echo "Đây là trang danh sách danh mục";
        $listDanhMuc = $this -> modelDanhMuc ->getAllDanhMuc(); 
        require_once "./views/danhmuc/litsdanhmuc.php";
    }
    // public function formAdddDanhMuc(){
    //     //hiện thị from nhập
    //     // var_dump("Đây là trang thêm mới danh mục");
    //     require_once "./views/danhmuc/adddanhmuc.php";
    // }
    // public function possAddDanhmuc(){
    //     //hàm xử lí them dữ liệu
    //     // var_dump($_POST);
    //     //kiểm tra dữ liệu được submit lên không
    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         $tenDanhMuc = $_POST['ten_danh_muc'];
    //         $moTa = $_POST['mo_ta'];
            
    //         //tạo 1 mảng trống để chứa dữ liệu
    //         $errors =[];
    //         if(empty($tenDanhMuc)){
    //             $errors['ten_danh_muc'] = "Tên danh mục không được để trống";
    //         }
    //         //nếu không có lỗi thì tiến hành thêm danh mục
    //         if(empty($errors)){
    //         //    var_dump("ok");
    //         $this->modelDanhMuc->insertDanhMuc($tenDanhMuc,$moTa);
    //         header("Location: " . BASE_URL_ADMIN . "?act=danhmuc");
    //         exit();
    //         }else{
    //             //nếu có lỗi thì hiển thị lại
    //             require_once "./views/danhmuc/adddanhmuc.php";
    //         }
    //     }
    // }
    
    public function formAdddDanhMuc(){
        if (isset($_POST['them'])) {
            $tenDanhMuc = $_POST['ten_danh_muc'];
            $moTa = $_POST['mo_ta'];
            $errors = [];
            if (empty($tenDanhMuc)) {
                $errors['ten_danh_muc'] = "Tên danh mục không được để trống";
            }
            if (empty($errors)) {
                $this->modelDanhMuc->insertDanhMuc($tenDanhMuc, $moTa);
                header("Location: http://localhost/base_du_an/admin/index.php?act=danhmuc");
                exit();
            }else{
                require_once "./views/danhmuc/adddanhmuc.php";
            }
        } else {
            require_once "./views/danhmuc/adddanhmuc.php";
        }
        
    }
     public function formEditDanhMuc(){
        //hiện thị from nhập
        // var_dump("Đây là trang thêm mới danh mục");
        //lấy ra thông tin danh mục cần sửa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getOneDanhMuc($id);
        if($danhMuc){
            require_once "./views/danhmuc/editDanhMuc.php";
        }else{
            header("Location: http://localhost/base_du_an/admin/index.php?act=danhmuc");
            exit();
        }
       
    }
    public function possEditDanhmuc(){
        //hàm xử lí them dữ liệu
        // var_dump($_POST);
        //kiểm tra dữ liệu được submit lên không
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //lấy ra thông tin danh mục cần sửa
            $id = $_POST['id'];
            $tenDanhMuc = $_POST['ten_danh_muc'];
            $moTa = $_POST['mo_ta'];
            
            //tạo 1 mảng trống để chứa dữ liệu
            $errors =[];
            if(empty($tenDanhMuc)){
                $errors['ten_danh_muc'] = "Tên danh mục không được để trống";
            }
            
            //nếu không có lỗi thì tiến hành sửa danh mục
            if(empty($errors)){
            //    var_dump("ok");
            $this->modelDanhMuc-> updatetDanhMuc($id,$tenDanhMuc,$moTa);
            header("Location: " . BASE_URL_ADMIN . "?act=danhmuc");
            exit();
            }else{
                //nếu có lỗi thì hiển thị lại
                $danhMuc = [
                    'id' => $id,
                    'ten_danh_muc' => $tenDanhMuc,
                    'mo_ta' => $moTa
                ];
                require_once "./views/danhmuc/editDanhMuc.php";
            }


        }
    }
    public function deleteDanhMuc(){
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getOneDanhMuc($id);
        if($danhMuc){
            $this->modelDanhMuc->xoaDanhMuc($id);
            $_SESSION['success'] = "Xoá danh mục thành công";
            header("Location: http://localhost/base_du_an/admin/index.php?act=danhmuc");
            exit();
        }else{
            header("Location: http://localhost/base_du_an/admin/index.php?act=danhmuc");
            exit();
        }
    }
}