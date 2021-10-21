<?php
require_once 'database.php';

class Client{

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
    public function insertUser($UserName){
        try{
          $stmt = $this->conn->prepare("INSERT INTO users_list (UserName, Cash_Balance) VALUES(:UserName, 1000)");
          $stmt->bindparam(":UserName", $UserName);
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