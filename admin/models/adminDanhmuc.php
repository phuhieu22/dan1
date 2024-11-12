<?php
class adminDanhmuc{
    public $conn;
    public function __construct(){
        $this-> conn = connectDB();
    }
    
    public function getAllDanhMuc(){
        $sql = "SELECT * FROM danh_mucs";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $resutl =  $stmt->fetchAll();
        return $resutl;      
    }
    public function insertDanhMuc($tenDanhMuc,$moTa){
        try {
            $sql = "INSERT INTO `danh_mucs`( `ten_danh_muc`, `mo_ta`) VALUES ('$tenDanhMuc','$moTa')";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
     }
     public function getOneDanhMuc($id){
        try {
            $sql = "SELECT * FROM danh_mucs where id = $id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();           
            return $stmt->fetch() ;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
     }
     public function updatetDanhMuc($id,$tenDanhMuc,$moTa){
        try {
            $sql = "UPDATE `danh_mucs` SET `ten_danh_muc`='$tenDanhMuc',`mo_ta`='$moTa' WHERE id = '$id'";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
     }
     public function xoaDanhMuc($id){
        try {
            $sql = "DELETE FROM `danh_mucs` WHERE id = '$id'";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            return true;
        } catch (Exception $e) {
            echo "Error: ". $e -> getMessage();
        }
     }
}