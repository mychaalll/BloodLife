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
    $query = "UPDATE `donortable` SET `Status`='reported' WHERE ID = $ID";
            
    mysqli_query($con, $query);
    $_SESSION['status'] = "Your report has been submitted. It will be reviewed by the admins";
    $_SESSION['status_code'] = "warning";
    header("Location: ../UserPage/userDonors.php");
    die;
?>