<?php
    session_start();

    include('includes/alerts.php');

    // Retriving the session Attributes.
    $userIDNumber = (isset($_SESSION['userIDNumber']))?     $_SESSION['userIDNumber']:'None';
    $userName =     (isset($_SESSION['userName']))?         $_SESSION['userName']:'None';
    $userEmail =    (isset($_SESSION['userEmail']))?        $_SESSION['userEmail']:'None';



        
    // If update Client Button is Clicked.
    if ( isset($_POST['updateClient']) ){
        
        // Retriving Form Data...
        $nUserName = $_POST['userName'];
        $nUserPhone = $_POST['userPhone'];
        $nUserCompany = $_POST['userCompany'];
        $nUserEmail = $_POST['userEmail'];
        $nUserAddress = $_POST['userAddress'];
        $nUserNotes = $_POST['userNotes'];
        
        $clientId = $_GET['clientId'];

        
        // Include the Connection File...
        include('./includes/connection.php');
        
        $query = "UPDATE uclients SET name='$nUserName',
            email='$nUserEmail',
            phoneno='$nUserPhone',
            company='$nUserCompany',
            address='$nUserAddress',
            notes='$nUserNotes' WHERE id=$clientId";
        
        
        $result = mysqli_query($conn,$query);
        if($result == 1){
            // Build Success Message.
            $message = alertSuccess('Record Successfully Updated.');
        }else{
            // Build Failure Message.
            $message = alertDanger('Record Falied To Update.');
        }
        
    }
    
    // If delete Client Button is Clicked.
    if ( isset($_POST['deleteClient']) ){
        
    }


    // Get the Client Details using client id.
    if( isset($_GET['clientId']) ){
        $clientId = $_GET['clientId'];
        
        // Including the Connection File.
        include('./includes/connection.php');
        
        // Query for getting single record form the database. 
        $query = "SELECT name,email,phoneno,company,address,notes FROM uclients WHERE id=$clientId AND uid=$userIDNumber LIMIT 1"; 
        
        $result = mysqli_query($conn, $query);
        
        if( mysqli_num_rows($result) > 0 ){
            $clientRecord = mysqli_fetch_assoc($result);
        }        
        
    
        // Closing the Connection.
        mysqli_close($conn);
        
    }
    

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Update Client</title>
  </head>
  <body>
      
      <header>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <a class="navbar-brand" href="home.php">Client <strong>Manager</strong></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ml-5">
                  <li class="nav-item active">
                    <a class="nav-link" href="addclient.php">Add Client</a>
                  </li>
                  <li class="nav-item"> 
                    <a class="nav-link" href="home.php">View Clients</a>
                  </li>
                </ul>                  
                <ul class="navbar-nav ml-auto">
                    
                  <li class="nav-item mr-3">
                    <a class="nav-link" href="home.php"><?php echo strtoupper($userName); ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                  </li>
                </ul>
                  
                
                
              </div>
            </nav>
      </header>

      
      
      

      <?php
            if(isset($message)){
                echo $message;
            }
      ?>
      
      
      <!-- Begin Model Code -->
        <!-- Modal -->
        <div class="modal fade" id="confirmDeleteModel" tabindex="-1" role="dialog" aria-labelledby="confirmModelLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmModelLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure to delete this client? 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  
                  <form action="delete.php" method="post" name="deleteClientForm">
                      <input type="submit" role="button" class="btn btn-danger" id="deleteClientBtn" value="Delete" name="deleteClientBtn">
                      <input type="number" hidden name="dcId" value="<?php echo $clientId; ?>">
                  </form>
              </div>
            </div>
          </div>
        </div>
      <!-- End Model Code -->
      
  
      <div class="container mt-4">
          

            <!-- Form Begins From Here... -->
            <form method="post" action="" name="newClient">          
              <div class="row">
                  
                      <div class="col-md-1"></div>    

                      <div class="col-md-5">
                              <div class="form-group">
                                <label for="userName">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="userName" placeholder="Enter Name" name="userName" required value="<?php echo $clientRecord['name']; ?>">

                              </div>
                              <div class="form-group">
                                <label for="userPhone">Phone Number</label>
                                <input type="number" class="form-control" id="userPhone" placeholder="Enter Phone" name="userPhone" required value="<?php echo $clientRecord['phoneno']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="userCompany">Company</label>
                                <input type="text" class="form-control" id="userCompany" placeholder="Enter Company Name" name="userCompany" required value="<?php echo $clientRecord['company']; ?>">
                              </div>
                          

                      </div>
                      <div class="col-md-5">
                              <div class="form-group">
                                <label for="userEmail">Email address</label>
                                <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" placeholder="Enter Email" name="userEmail" required value="<?php echo $clientRecord['email']; ?>">

                              </div>
                              <div class="form-group">
                                <label for="userAddress">Address</label>
                                <input type="text" class="form-control" id="userAddress" placeholder="Enter Address" name="userAddress" required value="<?php echo $clientRecord['address']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="userNotes">Notes</label>
                                  <textarea rows="3" type="text" class="form-control" id="userNotes" placeholder="Enter Notes..." name="userNotes" required><?php echo $clientRecord['notes']; ?></textarea>
                              </div>
                  </div>
                  <div class="col-md-1"></div>    
            </div><!-- End of Row -->
              <div class="row mt-5">
                  <div class="col-md-2">
                      <a href="./home.php" role="button"class="btn btn-outline-secondary btn-block btn-lg">Cancel</a>

                  </div>
                  <div class="col-md-6"></div>
                  <div class="col-md-2">
                      <a href="#" role="button" class="btn btn-outline-danger btn-block btn-lg" name="deleteClient" data-toggle="modal" data-target="#confirmDeleteModel">Delete</a>
                  </div>
                  
                  <div class="col-md-2">
                      <input type="submit" role="button" class="btn btn-outline-success btn-block btn-lg" value="Update" name="updateClient">
                      
                      
                  </div>
                
              </div><!-- End of Row-->
                
        </form>  <!-- End of Form -->
          
    </div><!-- End of Container -->
      
      
      <footer class="mt-5">
          <p class="text-center text-muted">Coded with Love by <a class="" href="#">Bilal</a> in BS4<span></span></p>
      </footer>
      
      
      
    <!-- Optional JavaScript -->
      <script type="text/javascript">
            document.getElementById("deleteClientBtn").onclick = function () {
                
                
                location.href = "home.php";
            };
      </script>
      
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>