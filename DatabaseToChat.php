<?php
    include "db_connect.php";
    $user = $_GET['name'];

    $checkName = $conn -> prepare("SELECT Name FROM Users WHERE Name = ?");
    $checkName -> bind_param("s", $user);
    $checkName -> execute();
    if ($checkName) {   
        $checkName -> bind_result($resultName);
        if ($checkName -> fetch()) {
            $checkName -> free_result();
            $getMessage = $conn -> prepare("SELECT Message FROM Users WHERE Name = ?");
            $getMessage -> bind_param("s", $user);
            $getMessage -> execute();
            if ($getMessage) {
                $getMessage -> bind_result($message);
                if ($getMessage -> fetch()) {
                    echo $message;
                }
            }
            else {
                echo "GET_ERROR";
            } 
        } 
        else {
            echo "INVALID_NAME";
        }
    } 
    else {  
        echo "QUERY_ERROR";
    }
    $conn -> close();
?>
