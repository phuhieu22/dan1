<?php
class adminDonHang
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDonHang()
    {
        $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
        from don_hangs 
        join trang_thai_don_hangs on don_hangs.trang_thai_id = trang_thai_don_hangs.id";


        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $resutl =  $stmt->fetchAll();
        return $resutl;
    }

    public function getDetaiDonHang($id)
    {
        try {
            $sql = "SELECT don_hangs.*, 
                trang_thai_don_hangs.ten_trang_thai ,
                tai_khoans.ho_ten,tai_khoans.email,tai_khoans.so_dien_thoai,
                phuong_thuc_thanh_toans.ten_phuong_thuc

                from don_hangs 
                join trang_thai_don_hangs on don_hangs.trang_thai_id = trang_thai_don_hangs.id 
                join tai_khoans on don_hangs.tai_khoan_id = tai_khoans.id
                join phuong_thuc_thanh_toans on don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
                WHERE don_hangs.id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $resutl =  $stmt->fetch();
            return $resutl;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getListDonHang($id)
    {
        try {
            $sql = "SELECT  chi_tiet_don_hangs.*, san_phams.ten_san_pham
            FROM chi_tiet_don_hangs
            join san_phams on chi_tiet_don_hangs.san_pham_id = san_phams.id
             WHERE chi_tiet_don_hangs.don_hang_id= '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $resutl =  $stmt->fetchAll();
            return $resutl;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getAllTrangThaiDonHang(){
        try {
            $sql = "SELECT * FROM `trang_thai_don_hangs` ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $resutl =  $stmt->fetchAll();
            return $resutl;
        }  catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
    }
    // public function insertSanPham($tenSanPham, $giaSanPham, $giaKhuyenMai, $soLuong, $moTa, $ngayNhap, $trangThai, $danhMucId, $file_thum)
    // {
    //     try {
    //         $sql = "INSERT INTO `don_hangs`(`ten_san_pham`, `gia_san_pham`, `gia_khuyen_mai`, `so_luong`, `mo_ta`, `ngay_nhap`, `trang_thai`,`danh_muc_id`, `hinh_anh`) 
    //         VALUES ('$tenSanPham','$giaSanPham','$giaKhuyenMai','$soLuong','$moTa','$ngayNhap','$trangThai','$danhMucId','$file_thum')";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();

    //         //lấy id sản phẩm vừa thêm
    //         return $this->conn->lastInsertId();
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // public function insertSanPhamImg($san_pham_id, $link_hinh_anh)
    // {
    //     try {
    //         $sql = "INSERT INTO `hinh_anh_don_hangs`( `san_pham_id`, `link_hinh_anh`) VALUES ('$san_pham_id','$link_hinh_anh')";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         return true;
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // public function getOneSanPham($id)
    // {
    //     try {
    //         $sql = "SELECT don_hangs.*, danh_mucs.ten_danh_muc
    //             from don_hangs 
    //             join danh_mucs on don_hangs.danh_muc_id = danh_mucs.id 
    //             WHERE don_hangs.id = '$id'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         $resutl =  $stmt->fetch();
    //         return $resutl;
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }
    // public function getAnhSanPham($id)
    // {
    //     try {
    //         $sql = "SELECT * FROM `hinh_anh_don_hangs` WHERE san_pham_id = '$id'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         $resutl =  $stmt->fetchAll();
    //         return $resutl;
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // public function updateSanPham($san_pham_id, $tenSanPham, $giaSanPham, $giaKhuyenMai, $soLuong, $moTa, $ngayNhap, $trangThai, $danhMucId, $newFile)
    // {
    //     try {
    //         $sql = "UPDATE `don_hangs` SET 
    //         `ten_san_pham`='$tenSanPham',
    //         `gia_san_pham`='$giaSanPham',
    //         `gia_khuyen_mai`='$giaKhuyenMai',
    //         `so_luong`='$soLuong',
    //         `mo_ta`='$moTa',
    //         `ngay_nhap`='$ngayNhap',
    //         `trang_thai`='$trangThai',
    //         `danh_muc_id`='$danhMucId'
    //         ,`hinh_anh`='$newFile' 
    //         WHERE id = '$san_pham_id'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();

    //         //lấy id sản phẩm vừa thêm
    //         return true;
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // public function getDetailAnhSanPham($id)
    // {
    //     try {
    //         $sql = "SELECT * FROM `hinh_anh_don_hangs` WHERE san_pham_id = '$id'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         $resutl =  $stmt->fetchAll();
    //         return $resutl;
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // public function updateAnhSanPham($id, $newFile)
    // {
    //     try {
    //         $sql = "UPDATE `hinh_anh_don_hangs` SET `link_hinh_anh`='$newFile' WHERE id = '$id'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         return true;
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }
    // public function deleteAnhSanPham($id)
    // {
    //     try {
    //         $sql = "DELETE FROM `hinh_anh_don_hangs` WHERE id = '$id'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         return true;
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }

    // public function XoaSanpham($id)
    // {
    //     try {
    //         $sql = "DELETE FROM `don_hangs` WHERE id = '$id'";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();
    //         return true;
    //     } catch (Exception $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }
}
