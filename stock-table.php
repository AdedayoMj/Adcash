

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 d-flex justify-content-center align-items-center">

                    <div class="table-responsive">
                    
                    <h1 style="margin-top: 10px">Stock List</h1>
                    <?php
                      if(isset($_GET['updated'])){
                        echo '<div class="alert alert-info alert-dismissable fade show  d-flex justify-content-between" role="alert">
                        <div><strong>Stock!</strong> Updated successfully.</div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['deleted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show d-flex justify-content-between" role="alert">
                        <div><strong>Stock!</strong> Deleted successfully.</div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['inserted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show d-flex justify-content-between" role="alert">
                       <div> <strong>Stock!</strong> Updated successfully.</div>
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
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                            <th scope="col">Company</th>
                            <th scope="col">Unit price</th>
                            <th scope="col">Update at</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <?php
                              $query = "SELECT * FROM stock_list";
                              $stmt = $objStock->runQuery($query);
                              $stmt->execute();
                        ?>
                        <tbody>
                        <?php if($stmt->rowCount() > 0){
                            while($rowStock = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <tr>
                                <td><?php print($rowStock['Company_Name']) ?></td>
                            
                                <td>€ <?php print($rowStock['Unit_Price']) ?></td>
                            
                                <td>
                                    <?php print($rowStock['Modified']) ?>
                                </td>
                          
                                <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span data-feather='more-horizontal'></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="create-stock.php?edit_id=<?php print($rowStock['Stock_ID'])?>">Update unit price</a>
                                        <a class="dropdown-item confirmation" href="index.php?delete_id=<?php print($rowStock['Stock_ID'])?>">Delete stock</a>
                                    </div>
                                </td>
                            </tr>

                        <?php } } ?>
                        </tbody>
                    </table>
                    </div>
                            </main>