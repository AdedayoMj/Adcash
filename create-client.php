
<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/user.php';


$objUser =new Client();

// POST
if(isset($_POST['btn_save'])){
    $UserName  = strip_tags($_POST['UserName']);
    try{
          if($objUser->insertUser($UserName)){
            $objUser->redirect('index.php?insert-client');
          }else{
            $objUser->redirect('index.php?error-user');
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
                    <div><h2 style='margin-top: 10px'>Create a new client</h2></div>                 
                        <div class="input-group mb-3 mt-4">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"> @</span>
                            </div>
                            <input required type="text"  name="UserName" id="UserName" class="form-control" placeholder="Username" aria-label="UserName" aria-describedby="basic-addon1">
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