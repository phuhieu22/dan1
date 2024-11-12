<?php 
class sanPham {
    public $conn;
    
    public function __construct()
    {
        $this -> conn = connectDB();
    }
    //viết hàm lấy toàn bộ danh sách sản phẩm
     public function getAllproducts(){
        try {
            $sql = "SELECT * FROM san_phams ";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $result = $stmt -> fetchAll();
            return $result;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
     }
}
?>