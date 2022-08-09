<?php

    session_start();

    include("../scripts/connection.php");
    include("../scripts/functions.php");

    if (!isset($_GET['id']))
    {
        echo "id not provided";

    }
    $ID = $_GET['id'];

    //save to database;
    $query = "UPDATE `users` SET `Hidden`='1' WHERE ID = $ID";
            
    mysqli_query($con, $query);
    $_SESSION['status'] = "User was deleted.";
    $_SESSION['status_code'] = "success";
    header("Location: ../AdminPage/adminUsers.php");
    die; 
?>