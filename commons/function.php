<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}


//thêm file 
function uploadFile($file, $folder) {
    $pathStorage = $folder.time().$file['name'];
    $from =$file['tmp_name'];
    $to= PATH_ROOT.$pathStorage;
    if(move_uploaded_file($from,$to)){
        return $pathStorage;
    }
}
//sửa file
//xoá  file
function deleteFile($file){
    $pathDelete= PATH_ROOT.$file;
    if(file_exists($pathDelete)){
        unlink($pathDelete);
    }
}



//xoá session sau khi load trang
function deleteSession(){
    if(isset($_SESSION['flash'])){
        unset($_SESSION['flash']);
        session_unset();
        session_destroy();
    }
}

//upload album
function uploadFileAbum($file, $folder, $key) {
    $pathStorage = $folder.time().$file['name'][$key];
    $from =$file['tmp_name'][$key];
    $to= PATH_ROOT.$pathStorage;
    if(move_uploaded_file($from,$to)){
        return $pathStorage;
    }
}

//format date
function formatDate($date){
    $date = date_create($date);
    return date_format($date,"d-m-Y");
}