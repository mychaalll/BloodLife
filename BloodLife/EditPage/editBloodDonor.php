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
  else
  {
    $location = "../AdminPage/adminDonors.php";
  }

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


  if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      //something was posted
      $first_name = $_POST['edit-first-name'];
      $middle_name = $_POST['edit-middle-name'];
      $last_name = $_POST['edit-last-name'];
      $blood_type = $_POST['edit-blood-type'];
      $full_address = $_POST['edit-full-address'];
      $city = $_POST['edit-city'];
      $region = $_POST['edit-region'];
      $contact_details = $_POST['edit-contact-details'];
      $comments = $_POST['edit-comments'];

      //error handlings
      if(is_numeric($first_name))
      {
        $error_msg = "First Name must not contain numbers";
      }
      else if(is_numeric($last_name))
      {
        $error_msg = "Last Name must not contain numbers";
      }
      else if(is_numeric($city))
      {
        $error_msg = "City must not contain numbers";
      }
      else
      {
        if(empty($middle_name))
        {
          $middle_name = " ";
        }
        //save to database;
        $query = "UPDATE `donortable` SET `FirstName`='$first_name',`MiddleName`='$middle_name',`LastName`='$last_name',`BloodType`='$blood_type',`FullAddress`='$full_address',`City`='$city',`Region`='$region',`ContactDetails`='$contact_details',`Comments`='$comments' WHERE ID = $ID";
        mysqli_query($con, $query);
        $_SESSION['status'] = "Donor entry was updated.";
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
    <title>Edit Donor</title>
    <link rel="stylesheet" href="../styles/createEntry.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Edit Blood Donor Entry</div>
    <div class = "error-message">
      <?php if (isset($error_msg)) { ?>
        <p class = "error"><?php echo $error_msg; ?></p>
        <?php } ?>
    </div>
    <div class="content">
      <form method = "POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" class = "first-name" name = "edit-first-name" placeholder="Enter First name" value = "<?= $data['FirstName']?>" required>
          </div>
          <div class="input-box">
            <span class="details">Middle Name</span>
            <input type="text" class = "middle-name" name = "edit-middle-name" placeholder="Enter Middle name. Write N/A if not applicable" value = "<?= $data['MiddleName']?>">
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" class = "last-name" name = "edit-last-name" placeholder="Enter Last name" value = "<?= $data['LastName']?>" required>
          </div>
          <div class="input-box">
            <span class="details">Blood Type</span>
            <select class = "choiceList" name = "edit-blood-type">
                <option disabled = "disabled">Choose a Blood Type</option>
                <option value = "A+" selected>A+</option>
                <option value = "O+">O+</option>
                <option value = "B+">B+</option>
                <option value = "AB-">AB-</option>
                <option value = "A-">A-</option>
                <option value = "O-">O-</option>
                <option value = "B-">B-</option>
                <option value = "AB-">AB-</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Full Address</span>
            <input type="text" name = "edit-full-address" placeholder="Enter your Full Address" value = "<?= $data['FullAddress']?>" required>
          </div>
          <div class="input-box">
            <span class="details">City</span>
            <input type="text" name = "edit-city" placeholder="Enter your City" value = "<?= $data['City']?>" required>
          </div>
          <div class="input-box">
            <span class="details">Region</span>
            <select class = "choiceList" name = "edit-region">
                <option disabled = "disabled">Choose a Region</option>
                <option value = "NCR" selected>NCR (National Capital Region)</option>
                <option value = "CAR">CAR (Cordillera Administrative Region)</option>
                <option value = "BARMM">BARMM (Bangsamoro)</option>
                <option value = "Region I">Region I (Ilocos Region)</option>
                <option value = "Region II">Region II (Cagayan Valley)</option>
                <option value = "Region III">Region III (Central Luzon)</option>
                <option value = "Region IV-A">Region IV-A (CALABARZON)</option>
                <option value = "Region IV-B">Region IV-B (MIMAROPA)</option>
                <option value = "Region V">Region V (Bicol Region)</option>
                <option value = "Region VI">Region VI (Western VIsayas)</option>
                <option value = "Region VII">Region VII (Central VIsayas)</option>
                <option value = "Region VIII">Region VIII (Eastern VIsayas)</option>
                <option value = "Region IX">Region IX (Zamboanga Peninsula)</option>
                <option value = "Region X">Region X (Northern Mindanao)</option>
                <option value = "Region XI">Region XI (Davao Region)</option>
                <option value = "Region XII">Region XII (Soccsksargen)</option>
                <option value = "Region XIII">Region XII (CARAGA)</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Contact Details</span>
            <textarea class = "comments" name = "edit-contact-details" placeholder = "Add Contact Details here" rows = "10" cols = "30" required><?= $data['ContactDetails']?></textarea>
          </div>
          <div class="input-box">
            <span class="details">Comments</span>
            <textarea class = "comments" name = "edit-comments" placeholder = "Add Comments here" rows = "10" cols = "30" required><?= $data['Comments']?></textarea>
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