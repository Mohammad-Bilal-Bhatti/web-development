<?php

    session_start();

    // Retriving the session Attributes.
    $userIDNumber = (isset($_SESSION['userIDNumber']))?     $_SESSION['userIDNumber']:'None';
    $userNamee =     (isset($_SESSION['userName']))?         $_SESSION['userName']:'None';
    $userEmail =    (isset($_SESSION['userEmail']))?        $_SESSION['userEmail']:'None';

    // Check for the Delete Client is SET.
    if ( isset($_POST['deleteClientBtn']) ){

        // Include the connection file.
        include('./includes/connection.php');
        
        
        // Fetching Client ID to Delete Record.
        $dcId = $_POST['dcId'];
        
        $query = "DELETE FROM uclients WHERE id=$dcId";
        
        $result = mysqli_query($conn, $query);
        
        // Close the Connection.
        mysqli_close($conn);
    
        if( $result == 1 ){
          header("Location: ./home.php"); 
          exit();            
        }
        
    }
    


?>