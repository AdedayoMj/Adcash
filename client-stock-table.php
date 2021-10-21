<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/purchase.php';


$objPurchase =new Purchase();


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
          <?php
                        if(isset($_GET['user_id'])){
                              $searchUserID = $_GET['user_id'];
                              $getUserQuery= "SELECT UserName FROM users_list WHERE UserID=:searchUserID;";
                              $query = "SELECT u.UserName, p.Volume, p.Purchase_Price,ROUND((((p.Volume*p.Purchase_Price)-(p.Volume*s.Unit_Price))/100),2) as Gain_Loss, s.Company_Name, s.Unit_Price FROM `purchase_list` as p INNER JOIN users_list as u ON u.UserID= p.UserPurchaseID INNER JOIN stock_list as s ON p.UserStockID=s.Stock_ID WHERE u.UserID=:searchUserID;";
                              $summarQuery = "SELECT ROUND(SUM(((p.Volume*p.Purchase_Price)-(p.Volume*s.Unit_Price))/100),2) as Profit, ROUND((SUM(p.Volume*p.Purchase_Price)),2) as Invested, ROUND(((SUM(((p.Volume*p.Purchase_Price)-(p.Volume*s.Unit_Price))/100)/(SUM(p.Volume*p.Purchase_Price)))*100),2) as Performace, ROUND((u.Cash_Balance-(SUM(p.Volume*p.Purchase_Price))),2) as Balance FROM `purchase_list` as p INNER JOIN users_list as u ON u.UserID= p.UserPurchaseID INNER JOIN stock_list as s ON p.UserStockID=s.Stock_ID WHERE u.UserID=:searchUserID;";
                              $stmt = $objPurchase->runQuery($query);
                              $summartStmt= $objPurchase->runQuery($summarQuery);
                              $getUser= $objPurchase->runQuery($getUserQuery);
                              $stmt->execute(array(":searchUserID" => $searchUserID));
                              $getUser->execute(array(":searchUserID" => $searchUserID));
                              $summartStmt->execute(array(":searchUserID" => $searchUserID));
                              $summaryView = $summartStmt->fetch(PDO::FETCH_ASSOC);
                              $infoUser = $getUser->fetch(PDO::FETCH_ASSOC);
                         } else{
                             
                                $stmt = 0;
                              }
                        ?>
              <h2 style="margin-top: 10px">List client's stocks <span><?php echo ($infoUser['UserName']) ?><span> </h2>
            
                    
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Company</th>
                            <th scope="col">Volume</th>
                            <th scope="col">Purchase Price</th>
                            <th scope="col">Current Price</th>
                            <th scope="col">Gain/Loss</th>
                            
                            </tr>
                        </thead>
                    
                        <tbody>
                        <?php if($stmt->rowCount() > 0){
                            while($rowView = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <tr>
                                <td><?php print($rowView['Company_Name']) ?></td>
                            
                                <td><?php print($rowView['Volume']) ?></td>
                            
                                <td>
                                € <?php print($rowView['Purchase_Price']) ?>
                                </td>
                          
                                <td>
                                €  <?php print($rowView['Unit_Price']) ?>
                                </td>
                                <td style='color: <?php echo($rowView['Gain_Loss']) >=0 ? '#33FF90':'#FF3C33' ?>'>
                                %  <?php print($rowView['Gain_Loss']) ?>
                                </td>
                            </tr>

                        <?php } } ?>
                        </tbody>
                    </table>
          
                   
                    <div class="row">
                    <div class='float-end  mt-1'> Total :  <span style='color: <?php echo($summaryView['Profit']) >=0 ? '#33FF90':'#FF3C33' ?>'>€ <?php print($summaryView['Profit']) ?></span></div>
                    </div>
                    <div class="row">
                    <div class='float-end  mt-1'> Invested :  € <?php print($summaryView['Invested']) ?></div>
                    </div>
                    <div class="row">
                    <div class='float-end  mt-1'> Performance :  <span style='color: <?php echo($summaryView['Performace']) >=0 ? '#33FF90':'#FF3C33' ?>'>% <?php print($summaryView['Performace']) ?></div>
                    </div>
                    <div class="row">
                    <div class='float-end  mt-1'> Cash Balance :  € <?php print($summaryView['Balance']) ?></div>
                    </div>
                    
                    </div>
            </main>

             <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>