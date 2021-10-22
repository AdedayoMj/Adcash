
<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/user.php';
require_once 'classes/stock.php';
require_once 'classes/purchase.php';



$objUser =new Client();
$objStock =new Stock();
$objPurchase= new Purchase();


// POST
if(isset($_POST['btn_save'])){
    if(!empty($_POST['UserPurchaseID']) && !empty($_POST['UserStockID']) ) {
        $UserPurchaseID  = strip_tags($_POST['UserPurchaseID']);
        $UserStockID  = strip_tags($_POST['UserStockID']);
        // $Volume  = strip_tags($_POST['Volume']);
        // $Purchase_Price  = $rowStock['Stock_ID'];
    
      
        
    try{

          // if($objPurchase->purchaseStockOption($UserPurchaseID, $UserStockID,$Volume )){
          //   $objPurchase->redirect('purchase-stock.php?purchased');
          // }else{
          //   $objPurchase->redirect('purchase-stock.php?error');
          // }
     }catch(PDOException $e){
       echo $e->getMessage();
     }
    }else {
        echo 'Please select the value.';
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
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 d-flex justify-content-center align-items-center" style="display: inline-block">
                    <form method='post'>
                    <div><h2 style='margin-top: 10px'>Purchase stock</h2></div>   
                    <?php
                      if(isset($_GET['purchased'])){
                        echo '<div class="alert alert-info alert-dismissable fade show  d-flex justify-content-between" role="alert">
                        <div><strong>Stock!</strong> Stock purchased successfully.</div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['error'])){
                        echo '<div class="alert alert-info alert-dismissable fade show d-flex justify-content-between" role="alert">
                        <div> <strong>DB Error!</strong> Something went wrong with your action. Try again!</div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }
                    ?>              
                        <div class="form-group mb-3 mt-4">
                        <?php
                              $query = "SELECT * FROM users_list";
                              $stmt = $objUser->runQuery($query);
                              $stmt->execute();
                        ?>
                            <select class="form-control form-select"  name="UserPurchaseID" id="UserPurchaseID" >
                            <option selected disabled  value="" >Choose client</option>
                            <?php if($stmt->rowCount() > 0){
                            while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option id='<?php print($rowUser['UserID']) ?>'  value='<?php print($rowUser['UserID']) ?>' selected=""><?php print($rowUser['UserName']) ?></option>
                                  <?php } } ?>
                            </select>

                            <div>
       
                            <?php
                             $stockQuery = "SELECT * FROM stock_list";
                             $result = $objStock->runQuery($stockQuery);
                             $result->execute();
                        ?>
                            <select class="form-control form-select mt-4"  name="UserStockID" id="UserStockID" >
                            <option selected disabled value="" >Choose stock</option>
                            <?php if($result->rowCount() > 0){
                            while($rowStock = $result->fetch(PDO::FETCH_ASSOC)){
                            ?>
                      
                            <option id='<?php print($rowStock['Stock_ID']) ?>' value='<?php print($rowStock['Stock_ID']) ?>' selected="<?php print($rowStock['Stock_ID']) ?>"><?php print($rowStock['Company_Name']) ?></option>
                                  <?php } } ?>
                            </select>
                            </div>
                           
<!-- 
                            <div class="form-group mt-4">
                            <input class="form-control" placeholder="Volume"  step="any" type="number" name="Volume" id="Volume" value=''  required/>
                        </div>
                        <div class="form-group mt-4" >
                            <input  class="form-control" placeholder="Purchase Price" step="any"  type="number" name="Purchase_Price" id="Purchase_Price" value='<?php print($rowStock['Unit_Price']) ?>'  disabled required/>
                        </div> -->
                        </div>           
                        <div class="row">
                            <div class="col-sm-12 form-group mt-3">
                                <button  type="submit" name="btn_save" value="Save" class="btn btn-md btn-primary float-end" >Add →</button>
                            </div>
                        </div>
                    </form>
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>