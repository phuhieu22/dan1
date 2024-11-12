<?php
class adminSanPham{
    public $conn;
    public function __construct(){
        $this-> conn = connectDB();
    }
    public function getAllSanPham(){
        $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc
        from san_phams 
        join danh_mucs on san_phams.danh_muc_id = danh_mucs.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $resutl =  $stmt->fetchAll();
        return $resutl;
    }
    public function insertSanPham($tenSanPham,$giaSanPham,$giaKhuyenMai,$soLuong,$moTa,$ngayNhap,$trangThai,$danhMucId,$file_thum){
        try {
            $sql = "INSERT INTO `san_phams`(`ten_san_pham`, `gia_san_pham`, `gia_khuyen_mai`, `so_luong`, `mo_ta`, `ngay_nhap`, `trang_thai`,`danh_muc_id`, `hinh_anh`) 
            VALUES ('$tenSanPham','$giaSanPham','$giaKhuyenMai','$soLuong','$moTa','$ngayNhap','$trangThai','$danhMucId','$file_thum')";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            
            //lấy id sản phẩm vừa thêm
            return $this ->conn-> lastInsertId();
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }

    public function insertSanPhamImg($san_pham_id,$link_hinh_anh){
        try {
            $sql = "INSERT INTO `hinh_anh_san_phams`( `san_pham_id`, `link_hinh_anh`) VALUES ('$san_pham_id','$link_hinh_anh')";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }

    public function getOneSanPham($id){
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc
                from san_phams 
                join danh_mucs on san_phams.danh_muc_id = danh_mucs.id 
                WHERE san_phams.id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $resutl =  $stmt->fetch();
            return $resutl;
        }  catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }
    public function getAnhSanPham($id){
        try {
            $sql = "SELECT * FROM `hinh_anh_san_phams` WHERE san_pham_id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $resutl =  $stmt->fetchAll();
            return $resutl;
        }  catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }

    public function updateSanPham($san_pham_id,$tenSanPham,$giaSanPham,$giaKhuyenMai,$soLuong,$moTa,$ngayNhap,$trangThai,$danhMucId,$newFile){
        try {
            $sql = "UPDATE `san_phams` SET 
            `ten_san_pham`='$tenSanPham',
            `gia_san_pham`='$giaSanPham',
            `gia_khuyen_mai`='$giaKhuyenMai',
            `so_luong`='$soLuong',
            `mo_ta`='$moTa',
            `ngay_nhap`='$ngayNhap',
            `trang_thai`='$trangThai',
            `danh_muc_id`='$danhMucId'
            ,`hinh_anh`='$newFile' 
            WHERE id = '$san_pham_id'";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            
            //lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }

    public function getDetailAnhSanPham($id){
        try {
            $sql = "SELECT * FROM `hinh_anh_san_phams` WHERE san_pham_id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $resutl =  $stmt->fetchAll();
            return $resutl;
        }  catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }

    public function updateAnhSanPham($id,$newFile){
        try {
            $sql = "UPDATE `hinh_anh_san_phams` SET `link_hinh_anh`='$newFile' WHERE id = '$id'";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
        
    }
    public function deleteAnhSanPham($id){
        try {
            $sql = "DELETE FROM `hinh_anh_san_phams` WHERE id = '$id'";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }

    public function XoaSanpham($id){
        try {
            $sql = "DELETE FROM `san_phams` WHERE id = '$id'";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }
   
}