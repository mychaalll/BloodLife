<?php
    session_start();

    include("../scripts/functions.php");
    include("../scripts/connection.php");

    $userdata = check_login($con);
    $userID = $userdata['ID'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            User Profile
        </title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width-device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Zilla+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"> -->
        <link rel = "stylesheet" type = "text/css" href = "../styles/userStyle.css">
        <script src = "../scripts/script.js"></script>
    </head>
    <body>
        <section>
            <input type="checkbox" id="check">
            <!-- header -->
            <header>
                <nav>
                    <a href="#"> <img src="../images/Save Lives.png" alt=""> </a>
                    <div class = "navigation">
                        <ul>
                            <li class="pro"> <a  href = "#">Profile</a></li>
                            <li> <a href = "userDonors.php">Blood Donors</a></li>
                            <li class="sbn"> <a href = "userNeeders.php">Blood Recipients</a></li>
                            <a href = "../index.php" id="button">Logout</a>
                        </ul>   
                    </div>
                </nav>
                <!-- buttons at top right -->
                
                <label for="check">
                    <i class="fa fa-bars menu-btn"></i>
                    <i class="fa fa-times close-btn"></i>
                </label>
            </header>
            <div class = "content" id = "content">
                <!-- profile form -->
                <div class = "profilePage" id = "profilePage">
                    <h1>Your Profile</h1>
                    <!-- container for profile -->
                    <div class = "user-container">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i><br>
                        <!-- info container -->
                        <div class = information-container>
                            <div class="d1">
                                <span class = "profile-label">Name: </span><span class = "name-span"><?= $userdata['LastName'] . ", " . $userdata['FirstName'] . " " . $userdata['MiddleName'] ?></span><br>
                            </div>

                            <div class="d2">
                                <span class = "profile-label">Email: </span><span class = "email-span"><?= $userdata['Email'] ?></span> <br>
                            </div>
                            
                            <div class="d3">
                                <span class = "profile-label">Phone Number: </span><span class = "pnumber-span"><?= $userdata['PhoneNumber'] ?></span>
                            </div>
                            </div>
                            
                        <div class="editInfo">
                            <a href = "../EditPage/editUser.php?id=<?= $userID ?>&&from=0" class = "info-btn">Edit your Info</a>
                        </div>
                    </div>
                    <!-- container for user donor records -->
                    <div class = "profileDonor-table" id = "profileDonor-table">
                        <h2>Your Donor Entries</h2>
                        <div class = "userTable-container">
                        <table class = "profileTable-donor">
                            <?php
                            //getting the table order
                            if (isset($_GET['order']))
                            {
                                $order = $_GET['order'];
                            }
                            else
                            {
                                $order = 'LastName';
                            }
                            //getting the table sorting
                            if (isset($_GET['sort']))
                            {
                                $sort = $_GET['sort'];
                            }
                            else
                            {
                                $sort = 'ASC';
                            }
                            if($sort == 'DESC')
                            {
                                $sort = 'ASC';
                            }
                            else
                            {
                                $sort = 'DESC';
                            }
                            echo "<thead>
                                    <tr>
                                        <th class = 'profile-table-header-name'><a href = '?order=LastName&&sort=$sort' id = 'table-header' class = 'name' ><i class='fa fa-sort' aria-hidden='true'></i>Name</a></th>
                                        <th class = 'profile-table-header-bloodType'><a href = '?order=BloodType&&sort=$sort' id = 'table-header' class = 'bloodtype' ><i class='fa fa-sort' aria-hidden='true'></i>Blood Needed</a></th>
                                        <th class = 'profile-table-header-fullAddress'><a href = '?order=FullAddress&&sort=$sort' id = 'table-header' class = 'Add' ><i class='fa fa-sort' aria-hidden='true'></i>Full Address</a></th>
                                        <th class = 'profile-table-header-city'><a href = '?order=City&&sort=$sort' id = 'table-header' class = 'city'><i class='fa fa-sort' aria-hidden='true'></i>City</a></th>
                                        <th class = 'profile-table-header-region'><a href = '?order=Region&&sort=$sort' id = 'table-header' class = 'region'><i class='fa fa-sort' aria-hidden='true'></i>Region</a></th>
                                        <th class = 'profile-table-header-contactDetails'><a href = '?order=ContactDetails&&sort=$sort' id = 'table-header' class = 'contact'><i class='fa fa-sort' aria-hidden='true'></i>Contact Details</a></th>
                                        <th class = 'profile-table-header-actions'><a href = '#' id = 'table-header' > </a></th>
                                    </tr>
                                </thead><tbody>";
                                
                                
                            $query = "SELECT ID,FirstName,MiddleName,LastName,BloodType,FullAddress,City,Region,ContactDetails,Comments FROM donortable WHERE CreatorID = '$userID' AND Status != 'deleted' ORDER BY $order $sort ";
                            $result = mysqli_query($con, $query);
                                        
                            //populate data from database
                            if ($result && mysqli_num_rows($result) > 0)
                            {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>";
                                    echo "<td class = 'profile-table-data-name'>" . $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MiddleName'] . "</td>";
                                    echo "<td class = 'profile-table-data-bloodType'>" . $row['BloodType'] . "</td>";
                                    echo "<td class = 'profile-table-data-fullAddress'>" . $row['FullAddress'] . "</td>";
                                    echo "<td class = 'profile-table-data-city'>" . $row['City'] . "</td>";
                                    echo "<td class = 'profile-table-data-region'>" . $row['Region'] . "</td>";
                                    echo "<td class = 'profile-table-data-contactDetails'>" . $row['ContactDetails'] . "</td>";
                                    echo "<td class = 'profile-table-data-actions'>";
                                    echo "<div class = 'table-buttons'>";
                                    echo "<a class = 'table-edit' href = '../EditPage/editBloodDonor.php?id= " .$row['ID'] ."&&from=0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a>";
                                    echo "<a class = 'table-delete' href = '../DeleteEntries/deleteDonor.php?id= " .$row['ID'] ."&&from=0'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>";
                                    echo "</div>";
                                    echo "</td";
                                    echo "</tr>";
                                }
                            }
                            else
                            {
                                echo "<div class = 'error-message'>";
                                echo "<p class = 'error'>No Entries to show</p>";
                                echo "</div>";
                            }
                            echo "</tbody>";
                            ?>    
                            </table>
                        </div>    
                    </div>
                    <!-- container for user needer entries -->
                    <div class = "profileDonor-table" id = "profileDonor-table">
                        <h2 class="yre">Your Recipient Entries</h2>
                        <div class = "userTable-container">
                            <table class = "profileTable-donor needer">
                            <?php
                            //getting the table order
                            if (isset($_GET['order']))
                            {
                                $order = $_GET['order'];
                            }
                            else
                            {
                                $order = 'LastName';
                            }
                            //getting the table sorting
                            if (isset($_GET['sort']))
                            {
                                $sort = $_GET['sort'];
                            }
                            else
                            {
                                $sort = 'ASC';
                            }
                            if($sort == 'DESC')
                            {
                                $sort = 'ASC';
                            }
                            else
                            {
                                $sort = 'DESC';
                            }
                            echo "<thead>
                                    <tr>
                                        <th class = 'hover profile-table-header-name'><a href = '?order=LastName&&sort=$sort' id = 'table-header' class = 'name' ><i class='fa fa-sort' aria-hidden='true'></i>Name</a></th>
                                        <th class = 'hover profile-table-header-bloodType'><a href = '?order=BloodType&&sort=$sort' id = 'table-header' class = 'bloodtype' ><i class='fa fa-sort' aria-hidden='true'></i>Blood Needed</a></th>
                                        <th class = 'hover profile-table-header-fullAddress'><a href = '?order=FullAddress&&sort=$sort' id = 'table-header' class = 'Add' ><i class='fa fa-sort' aria-hidden='true'></i>Full Address</a></th>
                                        <th class = 'hover profile-table-header-city'><a href = '?order=City&&sort=$sort' id = 'table-header' class = 'city'><i class='fa fa-sort' aria-hidden='true'></i>City</a></th>
                                        <th class = 'hover profile-table-header-region'><a href = '?order=Region&&sort=$sort' id = 'table-header' class = 'region'><i class='fa fa-sort' aria-hidden='true'></i>Region</a></th>
                                        <th class = 'profile-table-header-contactDetails'><a href = '?order=ContactDetails&&sort=$sort' id = 'table-header' class = 'contact'><i class='fa fa-sort' aria-hidden='true'></i>Contact Details</a></th>
                                        <th class = 'profile-table-header-actions'><a href = '#' id = 'table-header' > </a></th>
                                    </tr>
                                </thead><tbody>";
                                
                                
                            $query = "SELECT ID,FirstName,MiddleName,LastName,BloodType,FullAddress,City,Region,ContactDetails,Comments FROM needertable WHERE CreatorID = '$userID' AND Status != 'deleted' ORDER BY $order $sort ";
                            $result = mysqli_query($con, $query);
                                        
                            //populate data from database
                            if ($result && mysqli_num_rows($result) > 0)
                            {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr class = 'row'>";
                                    echo "<td class = 'profile-table-data-name'>" . $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MiddleName'] . "</td>";
                                    echo "<td class = 'profile-table-data-bloodType'>" . $row['BloodType'] . "</td>";
                                    echo "<td class = 'profile-table-data-fullAddress'>" . $row['FullAddress'] . "</td>";
                                    echo "<td class = 'profile-table-data-city'>" . $row['City'] . "</td>";
                                    echo "<td class = 'profile-table-data-region'>" . $row['Region'] . "</td>";
                                    echo "<td class = 'profile-table-data-contactDetails'>" . $row['ContactDetails'] . "</td>";
                                    echo "<td class = 'profile-table-data-actions'>";
                                    echo "<div class = 'table-buttons'>";
                                    echo "<a class = 'table-edit' href = '../EditPage/editBloodNeeder.php?id= " .$row['ID'] ."&&from=0'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a>";
                                    echo "<a class = 'table-delete' href = '../DeleteEntries/deleteNeeder.php?id= " .$row['ID'] ."&&from=0'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>";
                                    echo "</div>";
                                    echo "</td";
                                    echo "</tr>";
                                    
                                }
                            }
                            else
                            {
                                echo "<div class = 'error-message'>";
                                echo "<p class = 'error'>No Entries to show.</p>";
                                echo "</div>";
                            }
                            echo "</tbody>";
                            ?>    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>