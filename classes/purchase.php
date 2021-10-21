<?php
require_once 'database.php';

class Purchase{

    private  $conn;

    //constructor
    public function __construct(){
        $database= new Database();

        $db = $database->dbConnection();

        $this->conn = $db;
    }

    //execute queries SQL
    public function runQuery($sql){
        $stmt = $this->conn->prepare($sql);
        return $stmt;
      }


    //insert
    public function purchaseStockOption($UserPurchaseID,$UserStockID,$Volume){
        try{
          $stmt = $this->conn->prepare("INSERT INTO users_list (Volume) VALUES(:Volume)");
          // $stmt->bindparam(":UserPurchaseID", $UserPurchaseID);
          // $stmt->bindparam(":UserStockID", $UserStockID);
          $stmt->bindparam(":Volume", $Volume);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }


    //Redirect url method
    public function redirect($url){
        header("Location: $url");      
      }
}
?>