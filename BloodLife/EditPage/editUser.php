<?php

    session_start();

    include("../scripts/connection.php");
    include("../scripts/functions.php");


    if (!isset($_GET['id']))
    {
        echo "id not provided";
    }
    $ID = $_GET['id'];

    $path = $_GET['from'];
    $location = "";
    if($path == 0)
    {
        $location = "../UserPage/userProfile.php";
    }
    else
    {
        $location = "../AdminPage/adminUsers.php";
    }

    $query = "SELECT FirstName,MiddleName,LastName,Email,PhoneNumber,Gender,UserName,Password FROM users where ID = '$ID' ";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0)
    {
        $data = mysqli_fetch_assoc($result);
    }
    else
    {
        echo "no row";
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //something was posted
        $first_name = $_POST['regi_first_name'];
        $middle_name = $_POST['regi_middle_name'];
        $last_name = $_POST['regi_last_name'];
        $email = $_POST['regi_email'];
        $phone_number = $_POST['regi_phone_number'];
        $username = $_POST['regi_username'];
        $password = $_POST['regi_password'];
        $conpassword = $_POST['regi_conpassword'];
        $gender = $_POST['regi_gender'];

        if(is_numeric($first_name))
        {
            $error_msg = "First Name must not contain numbers";
        }
        else if(is_numeric($last_name))
        {
            $error_msg = "Last Name must not contain numbers";
        }
        else if(!is_numeric($phone_number))
        {
            $error_msg = "Phone Number must only contain numbers";
        }
        else if($password != $conpassword)
        {
            $error_msg = "Passwords do not match. Try again";
        }
        else
        {
            if(empty($middle_name))
            {
                $middle_name = " ";
            }
            //save to database;
            $query = "UPDATE `users` SET `FirstName`='$first_name',`MiddleName`='$middle_name',`Email`='$email',`PhoneNumber`='$phone_number',`UserName`='$username',`Password`='$password' WHERE ID = $ID";
            mysqli_query($con, $query);
            $_SESSION['status'] = "User was updated.";
            $_SESSION['status_code'] = "success";
            header("Location: $location");
            die;
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="../styles/createEntry.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

    <body>
        <div class="container">
            <div class="title">Edit User</div>
            <div class = "error-message">
                <?php if (isset($error_msg)) { ?>
                    <p class = "error"><?php echo $error_msg; ?></p>
                <?php } ?>
            </div>
            <div class="content">
                <form action="#" method="POST">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">First Name</span>
                            <input type="text" name="regi_first_name" placeholder="Enter your name" value = "<?= $data['FirstName']?>" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Middle Name</span>
                            <input type="text" name="regi_middle_name" placeholder="Enter your name" value = "<?= $data['MiddleName']?>">
                        </div>
                        <div class="input-box">
                            <span class="details">Last Name</span>
                            <input type="text" name="regi_last_name" placeholder="Enter your name" value = "<?= $data['LastName']?>" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" name="regi_email" placeholder="Enter your email" value = "<?= $data['Email']?>" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Phone Number</span>
                            <input type="tel" name="regi_phone_number" placeholder="Enter your phone number" value = "<?= $data['PhoneNumber']?>" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Username</span>
                            <input type="text" name="regi_username" placeholder="Enter your username" value = "<?= $data['UserName']?>" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" name="regi_password" placeholder="Enter your password" value = "<?= $data['Password']?>" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Confirm Password</span>
                            <input type="password" name="regi_conpassword" placeholder="Confirm your password" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Gender</span>
                            <select class = "choiceList" name = "regi_gender">
                                <option disabled = "disabled">Choose a Gender</option>
                                <option value = "Male">Male</option>
                                <option value = "Female">Female</option>
                                <option value = "Prefer not to say">Prefer not to say</option>
                            </select>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </body>


</html>