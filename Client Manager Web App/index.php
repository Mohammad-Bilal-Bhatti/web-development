<?php
   
  if(isset($_POST['login'])){
      
      // Include the connection file.
      include('includes/connection.php');
      
      // Include Alert Function file.
      include('includes/alerts.php');
      
      // Getting the Input values.
      $userEmail = $_POST['userEmail'];
      $userPassword = $_POST['userPassword'];
      
      $query = "SELECT id,name,email,password FROM users WHERE email='$userEmail'";
      
      $result = mysqli_query($conn, $query);
      
      if(mysqli_num_rows($result) > 0 ){
          // Get the first record form the database.
          $record = mysqli_fetch_assoc($result);

          // Check if the Password is matched or NOT!
          if(password_verify($userPassword , $record['password'])){
          //if($userPassword == $record['password']){
              
              // If password is matached!
              session_start();
              $_SESSION['userName'] = $record['name'];
              $_SESSION['userEmail'] = $record['email'];
              $_SESSION['userIDNumber'] = $record['id'];
              
              // Display the Login successful Message...
              $error = alertSuccess('Login Successful.');
              
              header("Location: ./home.php");
          }
          else{
              $error = alertInfo('Invalid Id or password combination.');
          }
      }else{
          $error = alertDanger('No email exists with that name.');
      }
      
      
      
      // Close the Connection...
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

    <title>Client Manager Login</title>
  </head>
  <body>
      
      <header>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
              <a class="navbar-brand" href="index.php">Client <strong>Manager</strong></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ml-5">
                  <li class="nav-item invisible">
                    <a class="nav-link" href="#">Add Client</a>
                  </li>
                  <li class="nav-item invisible"> 
                    <a class="nav-link" href="#">View Clients</a>
                  </li>
                </ul>                  
                <ul class="navbar-nav ml-auto">
                    
                  <li class="nav-item">
                    <a class="nav-link" href="signup.php">Signup</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php">Login</a>
                  </li>
                </ul>
                  
                
                
              </div>
            </nav>
            
      </header>
      
      <?php
        if(isset($error)){ echo $error; }
      ?>
      
      <div class="jumbotron">
          <h1 class="display-3 text-center">Client Manager.</h1>
          <p class="text-center">Clients On Your Finger Tips.</p>
      
      </div>
      
      
      <div class="container">
<!--
          <h1>Client Address Book</h1>
          <p class="lead">Login to your Account.</p>
-->
        
          <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                  <form method="post" action="">
                      <div class="form-group">
                        <label for="userEmail">Email address</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp" placeholder="Enter email" required>

                      </div>
                      <div class="form-group">
                        <label for="userPassword">Password</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password" required>
                      </div>

                      <input type="submit" name="login" class="btn btn-primary btn-lg btn-block" value="Login">
                      <a href="./signup.php" role="button" class="btn btn-secondary btn-lg btn-block">Signup</a>
                    </form>
                
              </div>
              <div class="col-md-3"></div>
          </div>
          
          
      </div>

      
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