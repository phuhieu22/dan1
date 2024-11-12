<?php
class sanPhamController
{
    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelSanPham = new adminSanPham();
        $this->modelDanhMuc = new adminDanhMuc();
    }
    public function sanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/sanpham/listsanpham.php';
    }
    public function formAddSanPham()
    {
        //hiện thị from nhập
        // var_dump("Đây là trang thêm mới danh mục");
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once "./views/sanpham/addsanpham.php";

        // xoá session sau khi load trang
        deleteSession();
    }
    public function possAddSanPham()
    {
        //hàm xử lí them dữ liệu
        // var_dump($_POST);
        //kiểm tra dữ liệu được submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $tenSanPham = $_POST['ten_san_pham'] ?? '';
            $giaSanPham = $_POST['gia_san_pham'] ?? '';
            $giaKhuyenMai = $_POST['gia_khuyen_mai'] ?? '';
            $soLuong = $_POST['so_luong'] ?? '';
            $moTa = $_POST['mo_ta'] ?? '';
            $ngayNhap = $_POST['ngay_nhap'] ?? '';
            // $trangThai=$_POST['trang_thai']?? '';
            // $danhMucId=$_POST['danh_muc_id']?? '';
            $trangThai = isset($_POST['trang_thai']) ? $_POST['trang_thai'] : null;
            $danhMucId = isset($_POST['danh_muc_id']) ? $_POST['danh_muc_id'] : null;

            $hinhAnh = $_FILES['hinh_anh'] ?? null;
            //lưu hình ảnh 
            $file_thum = uploadFile($hinhAnh, './uploads/');
            //mảng hình ảnh
            $img_array = $_FILES['img_array'];

            //tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($tenSanPham)) {
                $errors['ten_san_pham'] = "Tên sản phẩm không được để trống";
            }
            if (empty($giaSanPham)) {
                $errors['gia_san_pham'] = "Giá sản phẩm không được để trống";
            }
            if (empty($giaKhuyenMai)) {
                $errors['gia_khuyen_mai'] = "Giá Khuyến mãi sản phẩm không được để trống";
            }
            if (empty($soLuong)) {
                $errors['so_luong'] = "Số lượng sản phẩm không được để trống";
            }
            if (empty($ngayNhap)) {
                $errors['ngay_nhap'] = "Ngày nhập sản phẩm không được để trống";
            }
            if (!isset($trangThai)) {
                $errors['trang_thai'] = "Trạng thái sản phẩm không được để trống";
            }
            if (empty($danhMucId)) {
                $errors['danh_muc_id'] = "Danh mục sản phẩm không được để trống";
            }
            if ($hinhAnh["error"] !== 0) {
                $errors['hinh_anh'] = "Phải chọn hình ảnh";
            }
            $_SESSION["error"] = $errors;




            //nếu không có lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) {
                //    var_dump("ok");
                $san_pham_id = $this->modelSanPham->insertSanPham($tenSanPham, $giaSanPham, $giaKhuyenMai, $soLuong, $moTa, $ngayNhap, $trangThai, $danhMucId, $file_thum);


                //   xử lí thêm abum ảnh san phẩm img_array
                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key],
                        ];
                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertSanPhamImg($san_pham_id, $link_hinh_anh);
                    }
                }
                header("Location: " . BASE_URL_ADMIN . "?act=sanpham");
                exit();
            } else {
                //nếu có lỗi thì hiển thị lại
                // require_once "./views/sanpham/addsanpham.php";
                // đặt chỉ thị xoá session sau khi hiện thị form
                $_SESSION["flash"] = true;
                header("Location: " . BASE_URL_ADMIN . "index.php?act=form-them-san-pham");
                exit();
            }
        }
    }

    // public function formAdddDanhMuc(){
    //     if (isset($_POST['them'])) {
    //         $tenDanhMuc = $_POST['ten_danh_muc'];
    //         $moTa = $_POST['mo_ta'];
    //         $errors = [];
    //         if (empty($tenDanhMuc)) {
    //             $errors['ten_danh_muc'] = "Tên danh mục không được để trống";
    //         }
    //         if (empty($errors)) {
    //             $this->modelSanPham->insertDanhMuc($tenDanhMuc, $moTa);
    //             header("Location: http://localhost/base_du_an/admin/index.php?act=danhmuc");
    //             exit();
    //         }else{
    //             require_once "./views/danhmuc/adddanhmuc.php";
    //         }
    //     } else {
    //         require_once "./views/danhmuc/adddanhmuc.php";
    //     }

    // }
    public function formEditSanPham()
    {
        //hiện thị from nhập
        //lấy ra thông tin sản phẩm cần sửa
        $id = $_GET['id_san_pham'];
        $sanpham = $this->modelSanPham->getOneSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getAnhSanPham($id);
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        if ($sanpham) {
            require_once "./views/sanpham/editsanpham.php";
            deleteSession();
        } else {
            header("Location: http://localhost/base_du_an/admin/index.php?act=sanpham");
            exit();
        }
    }
    public function possEditSanPham()
    {
        //hàm xử lí them dữ liệu
        // var_dump($_POST);
        //kiểm tra dữ liệu được submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //lấy ra dữ liệu cũ
            //    var_dump("abc");
            //    die();
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            //truy vấn
            $sanPhamOld = $this->modelSanPham->getOneSanPham($san_pham_id);
            //LẤY ẢNh cũ để phụ vụ cho sủa ảnh
            $old_file = $sanPhamOld['hinh_anh'];

            $tenSanPham = $_POST['ten_san_pham'] ?? '';
            $giaSanPham = $_POST['gia_san_pham'] ?? '';
            $giaKhuyenMai = $_POST['gia_khuyen_mai'] ?? '';
            $soLuong = $_POST['so_luong'] ?? '';
            $moTa = $_POST['mo_ta'] ?? '';
            $ngayNhap = $_POST['ngay_nhap'] ?? '';
            // $trangThai=$_POST['trang_thai']?? '';
            // $danhMucId=$_POST['danh_muc_id']?? '';
            $trangThai = isset($_POST['trang_thai']) ? $_POST['trang_thai'] : null;
            $danhMucId = isset($_POST['danh_muc_id']) ? $_POST['danh_muc_id'] : null;

            $hinhAnh = $_FILES['hinh_anh'] ?? null;


            //tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($tenSanPham)) {
                $errors['ten_san_pham'] = "Tên sản phẩm không được để trống";
            }
            if (empty($giaSanPham)) {
                $errors['gia_san_pham'] = "Giá sản phẩm không được để trống";
            }
            if (empty($giaKhuyenMai)) {
                $errors['gia_khuyen_mai'] = "Giá Khuyến mãi sản phẩm không được để trống";
            }
            if (empty($soLuong)) {
                $errors['so_luong'] = "Số lượng sản phẩm không được để trống";
            }
            if (empty($ngayNhap)) {
                $errors['ngay_nhap'] = "Ngày nhập sản phẩm không được để trống";
            }
            if (!isset($trangThai)) {
                $errors['trang_thai'] = "Trạng thái sản phẩm không được để trống";
            }
            if (empty($danhMucId)) {
                $errors['danh_muc_id'] = "Danh mục sản phẩm không được để trống";
            }

            $_SESSION["error"] = $errors;
            //    var_dump($_SESSION["error"]);
            //    die();

            //logic sửa ảnh
            if (isset($hinhAnh) && $hinhAnh["error"] == UPLOAD_ERR_OK) {
                //upload ảnh mới leen
                $newFile = uploadFile($hinhAnh, './uploads/');
                if (!empty($old_file)) {
                    deleteFile($old_file);
                } else {
                    $newFile = $old_file;
                }
            }




            //nếu không có lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) {

                $san_pham_id = $this->modelSanPham->updateSanPham($san_pham_id, $tenSanPham, $giaSanPham, $giaKhuyenMai, $soLuong, $moTa, $ngayNhap, $trangThai, $danhMucId, $newFile);

                header("Location: " . BASE_URL_ADMIN . "?act=sanpham");
                exit();
            } else {
                //nếu có lỗi thì hiển thị lại
                // require_once "./views/sanpham/addsanpham.php";
                // đặt chỉ thị xoá session sau khi hiện thị form
                $_SESSION["flash"] = true;
                header("Location: " . BASE_URL_ADMIN . "index.php?act=form-sua-san-pham&id_san_pham=" . $san_pham_id);
                exit();
            }
        }
    }

    /** 
     *  //sủa abuml ảnh 
     * --sửa ảnh cũ
     *  thêm ảnh mới 
     * không thêm ảnh mơi
     * --không sửa ảnh cũ
     * thêm ảnh mới
     * không thêm ảnh mới
     * --xoá ảnh cũ
     * thêm ảnh mới
     * không thêm ảnh mới
     */
    public function possEditAnhSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            //lấy danh sách ảnh hiện tại của sản phẩm
            $listAnhSanPham = $this->modelSanPham->getAnhSanPham($san_pham_id);

            //xử lí các ảnh được gửi lên từ form
            $img_array = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete'])  : [];
            $curruent_img_ids = $_POST['current_img_ids'] ?? [];

            // khia báo mảng dể lưu ảnh mới hoặc thêm ảnh cũ
            $upload_files = [];
            // upload ảnh mới hoặc thay thế ảnh cũ
            foreach ($img_array['name'] as $key => $value) {
                if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                    $newFile = uploadFileAbum($img_array, './uploads/', $key);
                    if ($newFile) {
                        $upload_files[] = [
                            'id' => $curruent_img_ids[$key] ?? '',
                            'file' => $newFile,
                        ];
                    }
                }
            }

            // lưu ảnh mới vào db và xoá ảnh cũ
            foreach ($upload_files as $file_info) {
                if ($file_info['id']) {
                    // var_dump($file_info);
                    // die();
                    $old_file =   $this->modelSanPham->getDetailAnhSanPham($file_info['id']);


                    //cập nhập ảnh cũ
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

                    //xoá ảnh cũ
                    deleteFile($old_file);
                } else {
                    //thêm ảnh mới
                    $this->modelSanPham->insertSanPhamImg($san_pham_id, $file_info['file']);
                }
            }
            //xử lí xoá ảnh trong  db
            foreach ($listAnhSanPham as $anhSP) {
                $anh_id = $anhSP['id'];
                if (in_array($anh_id, $img_delete)) {
                    $this->modelSanPham->deleteAnhSanPham($anh_id);

                    //xoá file 
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }
            header("Location: " . BASE_URL_ADMIN . "index.php?act=form-sua-san-pham&id_san_pham=" . $san_pham_id);
            exit();
        }
    }


    // public function deleteSanPham(){
    //     $id = $_GET['id_san_pham'];
    //     $sanpham = $this->modelSanPham->getOneSanPham($id);

    //     $listAnhSanPham = $this->modelSanPham->getAllSanPham($id);


    //     if($sanpham){
    //         deleteFile($sanpham['hinh_anh']);
    //         $this->modelSanPham->XoaSanpham($id);

    //         $_SESSION['success'] = "Xoá sản phẩm thành công";
    //         header("Location: http://localhost/base_du_an/admin/index.php?act=sanpham");
    //         exit();
    //     }if($listAnhSanPham){
    //         foreach($listAnhSanPham as $key => $anhSP){
    //             deleteFile($anhSP['link_hinh_anh']);
    //             $this->modelSanPham->deleteAnhSanPham($anhSP['id']);
    //         }
    //     }    
    //     else{
    //         header("Location: http://localhost/base_du_an/admin/index.php?act=sanpham");
    //         exit();
    //     }
    // }
    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];

        // Lấy thông tin sản phẩm và ảnh
        $sanpham = $this->modelSanPham->getOneSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getAnhSanPham($id);

        if ($sanpham) {
            // Xóa ảnh chính
            deleteFile($sanpham['hinh_anh']);

            // Xóa các ảnh phụ
            if ($listAnhSanPham) {
                foreach ($listAnhSanPham as $anhSP) {
                    deleteFile($anhSP['link_hinh_anh']);
                    $this->modelSanPham->deleteAnhSanPham($anhSP['id']);
                }
            }

            // Xóa sản phẩm
            $this->modelSanPham->XoaSanpham($id);

            $_SESSION['success'] = "Xoá sản phẩm thành công";
        }

        header("Location: " . BASE_URL_ADMIN . "?act=sanpham");
        exit();
    }

    public function detaiSanPham()
    {
        //hiện thị from nhập
        //lấy ra thông tin sản phẩm cần sửa
        $id = $_GET['id_san_pham'];
        $sanpham = $this->modelSanPham->getOneSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getAnhSanPham($id);
        if ($sanpham) {
            require_once "./views/sanpham/detailSanPham.php";
        } else {
            header("Location: http://localhost/base_du_an/admin/index.php?act=sanpham");
            exit();
        }
    }
}