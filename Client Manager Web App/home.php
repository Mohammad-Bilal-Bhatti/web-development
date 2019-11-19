<?php
    session_start();

    include('includes/alerts.php');

    // Retriving the session Attributes.
    $userIDNumber = (isset($_SESSION['userIDNumber']))?     $_SESSION['userIDNumber']:'None';
    $userNamee =     (isset($_SESSION['userName']))?         $_SESSION['userName']:'None';
    $userEmail =    (isset($_SESSION['userEmail']))?        $_SESSION['userEmail']:'None';




    include('includes/connection.php');

    // Select all columns of the currenly signed in user...
    //$query = "SELECT id,name,email,phoneno,company,address,notes FROM 'user clients' WHERE uid=$userIDNumber";
    $query = "SELECT id,name,email,phoneno,company,address,notes FROM uclients WHERE uid=$userIDNumber";

    $result = mysqli_query($conn, $query);
    //mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Home</title>
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
                  <li class="nav-item">
                    <a class="nav-link" href="addclient.php">Add Client</a>
                  </li>
                  <li class="nav-item active"> 
                    <a class="nav-link" href="home.php">View Clients</a>
                  </li>
                </ul>                  
                <ul class="navbar-nav ml-auto">
                    
                  <li class="nav-item mr-3">
                    <a class="nav-link" href="home.php"><?php echo strtoupper($userNamee); ?></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                  </li>
                </ul>
                  
                
                
              </div>
            </nav>
      </header>
      
      <div class="container">
          <div class="row">
              
              <div class="col-md-1"></div>
              <div class="col-md-10 mt-5">
                  <div class="table-responsive-md">
                      <table class="table table-striped">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th hidden scope="col">Id</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">Company</th>
                              <th scope="col">Notes</th>
                              <th scope="col">Edit</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                function getTableRow($sno, $id, $name, $email, $phoneno, $address, $company, $notes){
                                  return "<tr>" . 
                                      "<th scope='row'>" . $sno ."</th>" .
                                      "<td hidden>" . $id . "</td>" .
                                      "<td>" . $name ."</td>" .
                                      "<td>" . $email ."</td>" .
                                      "<td>" . $phoneno ."</td>" .
                                      "<td>" . $address ."</td>" .
                                      "<td>" . $company ."</td>" .
                                      "<td>" . $notes ."</td>" .
                                      "<td>" . "<a role='button' class='btn btn-secondary' href='./update.php?clientId=$id'>" . "Edit" . "</a>" ."</td>" .
                                      "</tr>";
                                }
                                if (mysqli_num_rows($result) > 0) {
                                    // For each output row.
                                    $i_no = 1;
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $trow = getTableRow($i_no,$row['id'],$row['name'],$row['email'],$row['phoneno'],$row['address'],$row['company'],$row['notes']);
                                        echo $trow;
                                        $i_no++;  
                                    }
                                } else {
                                   // Do Nothing.
                                }    

                            ?>  

                          </tbody>
                        </table>
                  </div><!-- End Table Responsive -->
              </div>
              <div class="col-md-1"></div>
          </div><!-- End of Row -->
          
          <div class="row mt-4">
              <div class="col-md-5"></div>
              <div class="col-lg-2">
                  <a role="button" class="btn btn-block btn-success btn-lg" href="addclient.php">Add Client</a>
              </div>
              <div class="col-md-5"></div>
          </div><!-- End of Row -->
          
      </div><!-- End of Container -->
      
      
      <footer class="mt-5">
          <p class="text-center text-muted">Coded with Love by <a class="" href="#">Bilal</a> in BS4<span></span></p>
      </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>