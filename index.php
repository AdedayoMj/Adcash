<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/stock.php';
require_once 'classes/user.php';


$objUser =new Client();
$objStock =new Stock();

if(isset($_GET['delete_id'])){
  $Stock_ID = $_GET['delete_id'];
  try{
    if($Stock_ID != null){
      if($objStock->delete($Stock_ID)){
        $objStock->redirect('index.php?deleted');
      }
    }else{
      var_dump($Stock_ID);
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Head metas, css, and title -->
        <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
        <!-- Header banner -->
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar menu -->
                <?php require_once 'includes/sidebar.php'; ?>
                <!-- Table views -->         
                
               
                  
                <?php require_once 'stock-table.php'; ?>
                <?php require_once 'client-table.php'; ?>
                
             
            </div>
           
                     
           
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
        <!-- Custom scripts -->
        <script>
            // JQuery confirmation
            $('.confirmation').on('click', function () {
                return confirm('Are you sure you want do delete this user?');
            });
        </script>
    </body>
</html>