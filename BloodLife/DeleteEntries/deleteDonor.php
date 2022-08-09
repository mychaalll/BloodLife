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

    $path = $_GET['from'];
    $location = "";
    if($path == 0)
    {
        $location = "../UserPage/userProfile.php";
    }
    else if ($path == 1)
    {
        $location = "../AdminPage/adminDonors.php";
    }

    else{
        $location = "../AdminPage/adminReport.php";
    }
    //save to database;
    $query = "UPDATE `donortable` SET `Status`='deleted' WHERE ID = $ID";
            
    mysqli_query($con, $query);
    $_SESSION['status'] = "Donor entry was deleted.";
    $_SESSION['status_code'] = "success";
    header("Location: $location");
    die;
    
?>