 
 

          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 d-flex justify-content-center align-items-center">
          <div class="table-responsive ">
                    <h1 style="margin-top: 10px">Client List </h1>
                    <?php
                      if(isset($_GET['insert-client'])){
                        echo '<div class="alert alert-info alert-dismissable fade show   d-flex justify-content-between" role="alert">
                       <div> <strong>Client!</strong> created  successfully.</div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['error-user'])){
                        echo '<div class="alert alert-info alert-dismissable fade show d-flex justify-content-between" role="alert">
                        <div> <strong>DB Error!</strong> Something went wrong with your action. Try again!</div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }
                    ?>
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
                                        <a class="dropdown-item" href="client-stock-table.php?user_id=<?php print($rowUser['UserID'])?>">View stocks</a>
                                      
                                    </div>
                                </td>
                            </tr>

                        <?php } } ?>
                        </tbody>
                    </table>
                    </div>
            </main>