<?php
    session_start();
    include("../scripts/connection.php");
    include("../scripts/functions.php");

    $userCount = userStatistics($con);
    $donorCount = donorStatistics($con);
    $neederCount = neederStatistics($con);

?>


<!DOCTYPE html>
<html>
<head>
        <title>
            Admin Report Page
        </title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width-device-width, initial-scale">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Zilla+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"> -->
        <link rel = "stylesheet" type = "text/css" href = "../styles/adminStyle4.css">
        <script src = "scripts/script.js"></script>
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
                            <li><a class = "pro" href = "adminDashboard.php">Dashboard</a></li>
                            <li><a href="#">Reported</a></li>
                            <li><a href="adminUsers.php">Users</a></li>
                            <li><a href="adminDonors.php">Blood Donors</a></li>
                            <li><a class ="sbn" href="adminNeeders.php">Blood Recipient</a></li>
                            <a class="logout" id = "button" href="../index.php">Logout</a>
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
                <!-- admin form -->
                <div class = "dashboardPage" id = "dashboard" >
                    <h1>Report Entries</h1><br>
                    <div class = "profileDonor-table" id = "profileDonor-table">
                        <h2>Blood Donors</h2>
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
                                        <th class = 'profile-table-header-contactDetails'><a href = '?order=ContactDetails&&sort=$sort' id = 'table-header' class = 'contact'>Contact Details</a></th>
                                        <th class = 'profile-table-header-contactDetails'><a href = '?order=Date&&sort=$sort' id = 'table-header' class = 'date'><i class='fa fa-sort' aria-hidden='true'></i>Date</a></th>
                                        <th class = 'profile-table-header-actions'><a href = '#' id = 'table-header' > </a></th>
                                    </tr>
                                </thead><tbody>";
                                
                                
                            $query = "SELECT ID,FirstName,MiddleName,LastName,BloodType,FullAddress,City,Region,ContactDetails,Date,Comments FROM donortable WHERE Status = 'reported' ORDER BY $order $sort ";
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
                                    echo "<td class = 'profile-table-data-date'>" . $row['Date'] . "</td>";
                                    echo "<td class = 'profile-table-data-actions'>";
                                    echo "<div class = 'table-buttons'>";
                                    echo "<a class = 'table-edit' href = '../ReportPage/denyDonor.php?id= " .$row['ID'] ."&&from=2'>Deny</a>";
                                    echo "<a class = 'table-delete' href = '../DeleteEntries/deleteDonor.php?id= " .$row['ID'] ."&&from=2'>Delete</a>";
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
                        <h2 class="ype">Blood Recipient</h2>
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
                                        <th class = 'profile-table-header-name'><a href = '?order=LastName&&sort=$sort' id = 'table-header' class = 'name' ><i class='fa fa-sort' aria-hidden='true'></i>Name</a></th>
                                        <th class = 'profile-table-header-bloodType'><a href = '?order=BloodType&&sort=$sort' id = 'table-header' class = 'bloodtype' ><i class='fa fa-sort' aria-hidden='true'></i>Blood Needed</a></th>
                                        <th class = 'profile-table-header-fullAddress'><a href = '?order=FullAddress&&sort=$sort' id = 'table-header' class = 'Add' ><i class='fa fa-sort' aria-hidden='true'></i>Full Address</a></th>
                                        <th class = 'profile-table-header-city'><a href = '?order=City&&sort=$sort' id = 'table-header' class = 'city'><i class='fa fa-sort' aria-hidden='true'></i>City</a></th>
                                        <th class = 'profile-table-header-region'><a href = '?order=Region&&sort=$sort' id = 'table-header' class = 'region'><i class='fa fa-sort' aria-hidden='true'></i>Region</a></th>
                                        <th class = 'profile-table-header-contactDetails'><a href = '?order=ContactDetails&&sort=$sort' id = 'table-header' class = 'contact'>Contact Details</a></th>
                                        <th class = 'profile-table-header-contactDetails'><a href = '?order=Date&&sort=$sort' id = 'table-header' class = 'date'><i class='fa fa-sort' aria-hidden='true'></i>Date</a></th>
                                        <th class = 'profile-table-header-actions'><a href = '#' id = 'table-header' > </a></th>
                                    </tr>
                                </thead><tbody>";
                                
                                
                            $query = "SELECT ID,FirstName,MiddleName,LastName,BloodType,FullAddress,City,Region,ContactDetails,Date,Comments FROM needertable WHERE Status = 'reported' ORDER BY $order $sort ";
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
                                    echo "<td class = 'profile-table-data-date'>" . $row['Date'] . "</td>";
                                    echo "<td class = 'profile-table-data-actions'>";
                                    echo "<div class = 'table-buttons'>";
                                    echo "<a class = 'table-edit' href = '../ReportPage/denyNeeder.php?id= " .$row['ID'] ."&&from=2'>Deny</a>";
                                    echo "<a class = 'table-delete' href = '../DeleteEntries/deleteNeeder.php?id= " .$row['ID'] ."&&from=2'>Delete</a>";
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
                </div>
            </div>
        </section>
</html>