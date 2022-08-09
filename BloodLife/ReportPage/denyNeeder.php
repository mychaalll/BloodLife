<?php

    session_start();

    include("../scripts/connection.php");
    include("../scripts/functions.php");

    if (!isset($_GET['id']))
    {
        echo "id not provided";

    }
    if (!isset($_GET['from']))
    {
        echo "path not provided";
    }
    $ID = $_GET['id'];

    //save to database;
    $query = "UPDATE `needertable` SET `Status`='show' WHERE ID = $ID";
            
    mysqli_query($con, $query);
    $_SESSION['status'] = "Report appeal denied.";
    $_SESSION['status_code'] = "error";
    header("Location: ../AdminPage/adminReport.php");
    die;
?>