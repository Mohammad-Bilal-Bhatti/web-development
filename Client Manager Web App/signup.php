<?php
    
    include('./includes/alerts.php');

    // When signup form button is clicked.
    if( isset($_POST['singup']) ){
        
        // Get the input field values.
        $uName = $_POST['userName'];
        $uEmail = $_POST['userEmail'];
        $uPassword = $_POST['userPassword'];
        
        # Convert the password into Hashed password. 
        $uPassword = password_hash($uPassword, PASSWORD_DEFAULT);
        
        // include the connection file.
        include('./includes/connection.php');
        
        $query = "INSERT INTO users(name,email,password,signup_date,comments) VALUES('$uName','$uEmail','$uPassword',CURRENT_TIMESTAMP,'No Comments')";
        
//        echo $query;
        
        $result = mysqli_query($conn, $query);
        
        if($result == 1){
            $message = alertSuccess('Account Successfully Created!');

        }else{
            $message = alertDanger('Failed to Create Account!');
        }
        
        
        // Close the connection.
        mysqli_close($conn);
        
    }

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>User SingUp</title>
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
                    
                  <li class="nav-item active">
                    <a class="nav-link" href="signup.php">Signup</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">Login</a>
                  </li>
                </ul>
              </div>
            </nav>
      </header>
      
      <?php
        if( isset($message) ){
            echo $message;
        }
      ?>
      
      <div class="container">
        <h1 id="pHeading">Client Manager</h1>
        <p class='lead'>Regsiter to our app in just few clicks.</p>
        
          <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                  
                  <!-- Submit the form to self -->
                  <form name="signupForm" method="post" action="" onsubmit="return isPasswordMatched()">
                      <div class="form-group">
                          <label for="userName">Your Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="userName" placeholder="Enter Your Name" name="userName" required>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="userEmail" required>
                      </div>

                      <div class="form-group">
                        <label for="userPassword">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="userPassword" placeholder="Password" name="userPassword" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="userConfirmPassword">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="userConfirmPassword" placeholder="Confirm Password" name="userConfirmPassword" required data-container="body" data-toggle="popover" data-placement="right" data-content="Confirm Password Not Matched!">
                      </div>
                      
                      <button type="submit" class="btn btn-primary btn-block btn-lg" name="singup">Signup</button>
                    </form>
              </div>
              <div class="col-md-3"></div>
          </div> <!-- End of Row -->
          
          
          
      
      </div>
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script type="text/javascript">

        function isPasswordMatched(){
            var uPass = document.forms['signupForm']['userPassword'];
            var ucPass = document.forms['signupForm']['userConfirmPassword'];
            if(uPass.value != ucPass.value){
                // Show the Pop-over.
                $("#userConfirmPassword").popover('show');
                return false;   // If password did't matched return false.
            }
            // Hide the Pop-over.
            $("#userConfirmPassword").popover('hide');
            return true;
        }
    </script>  
      
      
  </body>
</html>