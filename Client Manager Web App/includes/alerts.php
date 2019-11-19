<?php
    function alertDanger($message){
        return "<div class='alert alert-danger'>$message<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";        
    }
    
    function alertWarning($message){
        return "<div class='alert alert-warning'>$message<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";        
    }

    function alertSuccess($message){
        return "<div class='alert alert-success'>$message<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";        
    }

    function alertInfo($message){
        return "<div class='alert alert-info'>$message<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
    }

?>