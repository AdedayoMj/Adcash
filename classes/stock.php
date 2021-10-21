<?php
require_once 'database.php';

class Stock{

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
    public function insert($Company_Name, $Unit_Price){
        try{
          $stmt = $this->conn->prepare("INSERT INTO stock_list (Company_Name, Unit_Price) VALUES(:Company_Name, :Unit_Price)");
          $stmt->bindparam(":Company_Name", $Company_Name);
          $stmt->bindparam(":Unit_Price", $Unit_Price);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }


    //Update

    public function update($Company_Name, $Unit_Price, $Stock_ID){
        try{
          $stmt = $this->conn->prepare("UPDATE stock_list SET Company_Name = :Company_Name, Unit_Price = :Unit_Price WHERE Stock_ID = :Stock_ID");
          $stmt->bindparam(":Company_Name", $Company_Name);
          $stmt->bindparam(":Unit_Price", $Unit_Price);
          $stmt->bindparam(":Stock_ID", $Stock_ID);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }



    //Delete
    public function delete($Stock_ID){
        try{
          $stmt = $this->conn->prepare("DELETE FROM stock_list WHERE Stock_ID = :Stock_ID");
          $stmt->bindparam(':Stock_ID',$Stock_ID);
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