<?php
    session_start();

    include("../scripts/connection.php");
    include("../scripts/functions.php");

    if (!isset($_GET['id']))
    {
        echo "id not provided";

    }
    $ID = $_GET['id'];
    $query = "SELECT FirstName,MiddleName,LastName,BloodType,FullAddress,City,Region,ContactDetails,Comments FROM donortable where ID = '$ID' ";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0)
    {
        $data = mysqli_fetch_assoc($result);
    }
    else
    {
        echo "no row";
    }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Donor Details</title>
    <link rel="stylesheet" href="../styles/seeDetails.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="title">Blood Donor Details</div>
        <div class="content">
            <form>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type = "text" class="first-name" name = "detail-first-name" value = "<?= $data['FirstName']?>" disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">Middle Name</span>
                        <input type = "text" class="middle-name" name = "detail-middle-name" value = "<?= $data['MiddleName']?>" disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type = "text" class="last-name" name = "detail-last-name" value = "<?= $data['LastName']?>" disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">Blood Type</span>
                        <input type = "text" class="blood-type" name = "detail-blood-type" value = "<?= $data['BloodType']?>" disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">Full Address</span>
                        <input type = "text" class = "full-address" name = "detail-full-address" value = "<?= $data['FullAddress']?>" disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">City</span>
                        <input type = "text" class = "city" name = "detail-city" value = "<?= $data['City']?>" disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">Region</span>
                        <input type = "text" class = "region" name = "detail-region" value = "<?= $data['Region']?>" disabled>
                    </div>
                    
                    <div class = "textarea-container">
                        <div class="input-box">
                            <span class="details">Contact Details</span>
                            <textarea class = "comments" name = "detail-contact-details" readonly ><?= $data['ContactDetails']?> </textarea>
                        </div>
                        <div class="input-box">
                            <span class="details">Comments</span>
                            <textarea class = "comments" name = "detail-comments" readonly><?= $data['Comments']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="button">
                    <a href="../UserPage/userDonors.php"><input type="button" value="Go Back"></a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>