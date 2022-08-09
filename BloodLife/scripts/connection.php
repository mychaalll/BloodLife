<?php


    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "bloodlife";

    if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
    {
        die("database failed to connect");
    }
?>