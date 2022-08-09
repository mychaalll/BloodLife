<?php

  session_start();

  include("../scripts/connection.php");
  include("../scripts/functions.php");

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
      $query = "insert into users (FirstName,MiddleName,LastName,Email,PhoneNumber,Gender,UserName,Password) values ('$first_name','$middle_name','$last_name','$email','$phone_number','$gender','$username','$password')";
      mysqli_query($con, $query);
      $_SESSION['status'] = "Account was created successfully.";
      $_SESSION['status_code'] = "success";
      header("Location: ../HomeLogin.php");
      die;
    }
  }
?>



<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="../styles/createEntry.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class = "error-message">
      <?php if (isset($error_msg)) { ?>
        <p class = "error"><?php echo $error_msg; ?></p>
        <?php } ?>
    </div>
    <div class="content">
      <form action="#" method = "POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name = "regi_first_name" placeholder="Enter your First name." required>
          </div>
          <div class="input-box">
            <span class="details">Middle Name</span>
            <input type="text" name = "regi_middle_name" placeholder="Enter your Middle name.">
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name = "regi_last_name" placeholder="Enter your Last name." required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name = "regi_email" placeholder="Enter your Email." required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name = "regi_phone_number" placeholder="Enter your Phone number." required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name = "regi_username" placeholder="Enter your Username." required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name = "regi_password" placeholder="Enter your password." required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name = "regi_conpassword" placeholder="Confirm your password." required>
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
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>

</body>


</html>
