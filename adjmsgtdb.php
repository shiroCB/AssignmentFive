<?php
    include "db_connect.php";
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $text = $_POST['text'];

    $checkName = $conn -> prepare("SELECT Name, Password FROM Users WHERE Name = ? AND Password = ?");
    $checkName -> bind_param("ss", $name, $pass);
    if ($checkName -> execute()) {   
        $checkName -> bind_result($a, $b);
        if ($checkName -> fetch()) {
            $checkName -> free_result();
            $update = $conn -> prepare("UPDATE Users SET Message = ? WHERE Name = ? AND Password = ?");
            $update -> bind_param("sss", $text, $name, $pass);
            if ($update -> execute()) {
                echo "SUCCESS";
            } else {
                echo "UPDATE_ERROR";
            }    
        } 
        else {
            echo "INVALID_LOGIN";
        }
    } 
    else {  
        echo "QUERY_ERROR";
    }
    $conn -> close();
?>