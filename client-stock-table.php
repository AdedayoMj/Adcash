<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/user.php';


$objUser =new Client();


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
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 d-flex justify-content-center align-items-center">
          <div class="table-responsive ">
             
              <h1 style="margin-top: 10px">List clients stocks </h1>
            
                    
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Client</th>
                            <th scope="col">Cash Balance</th>
                            <th scope="col">Gain/Loss</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <?php
                              $query = "SELECT * FROM users_list";
                              $stmt = $objUser->runQuery($query);
                              $stmt->execute();
                        ?>
                        <tbody>
                        <?php if($stmt->rowCount() > 0){
                            while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <tr>
                                <td><?php print($rowUser['UserName']) ?></td>
                            
                                <td>€ <?php print($rowUser['Cash_Balance']) ?></td>
                            
                                <td>
                                    
                                </td>
                          
                                <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span data-feather='more-horizontal'></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="form.php?edit_id=<?php print($rowUser['UserID'])?>">View stocks</a>
                                      
                                    </div>
                                </td>
                            </tr>

                        <?php } } ?>
                        </tbody>
                    </table>
                    </div>
            </main>

             <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>