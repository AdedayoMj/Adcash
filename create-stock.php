
<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/stock.php';

$objStock = new Stock();


// GET all information
if(isset($_GET['edit_id'])){
    $Stock_ID = $_GET['edit_id'];
    $stmt = $objStock->runQuery("SELECT * FROM stock_list WHERE Stock_ID=:Stock_ID");
    $stmt->execute(array(":Stock_ID" => $Stock_ID));
    $rowStock = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
  $Stock_ID = null;
  $rowStock = null;
}

// POST
if(isset($_POST['btn_save'])){
    $Company_Name  = strip_tags($_POST['Company_Name']);
    $Unit_Price    = strip_tags($_POST['Unit_Price']);

    try{
        if($Stock_ID != null){
          if($objStock->update($Company_Name, $Unit_Price, $Stock_ID)){
            $objStock->redirect('index.php?updated');
          }
        }else{
          if($objStock->insert($Company_Name, $Unit_Price)){
            $objStock->redirect('index.php?inserted');
          }else{
            $objStock->redirect('index.php?error');
          }
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
                <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4 d-flex justify-content-center align-items-center" style="display: inline-block">
                    
                   
                    <form method='post'>
                    <div><h2 style='margin-top: 10px'>Create a new stock</h2></div>
                        
                        <div class="form-group mt-4">
                            <input class="form-control" placeholder="Company name" type="text" name="Company_Name" id="Company_Name" value="<?php $rowStock&& print($rowStock['Company_Name'])?>"   required/>
                        </div>
                       
                        
                        <div class="input-group mb-3 mt-4">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"> €</span>
                            </div>
                            <input type="number" step="any" name="Unit_Price" id="Unit_Price" class="form-control" placeholder="Unit price" aria-label="Unit_Price" value="<?php print($rowStock['Unit_Price']) ?>" required aria-describedby="basic-addon1" >
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