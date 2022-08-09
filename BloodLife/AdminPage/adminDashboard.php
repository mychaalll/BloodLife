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
            Admin Dashboard
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
        <link rel = "stylesheet" type = "text/css" href = "../styles/adminStyle.css">
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
                            <li><a class = "pro" href = "#">Dashboard</a></li>
                            <li><a href="adminReport.php">Reported</a></li>
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
                    <h1>Dashboard</h1><br>
                    <div class = "dashboard-statistics">
                        <h2>Statistics</h2>
                        <div class= "stats-cont-outer">
                            <div class = "stats-container">
                                <div class = "stats-container-inner1" >
                                    <h3><?= $userCount?></h3><p>Current Users</p>
                                </div>
                                <div class = "stats-container-inner2" >
                                    <h3><?= $donorCount?></h3><p>Current Donor Entries</p>
                                </div>
                                <div class = "stats-container-inner3" >
                                    <h3><?= $neederCount?></h3><p>Current Needer Entries</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- container for user donor records -->
                    <div class = "dashboardDonor-table" id = "dashboardDonor-table">
                        <h2>Recent Donor Entry</h2>
                        <div class = "error-message">
                        <div class = "donorTable-container">
                            <table class = "dashboardTable-donor">
                                <!-- table headers -->
                                <thead>
                                <tr>
                                    <th class = "dashboard-donor-table-header-ID">ID</th>
                                    <th class = "dashboard-donor-table-header-creatorID">CreatorID</th>
                                    <th class = "dashboard-donor-table-header-name">Name</th>
                                    <th class = "dashboard-donor-table-header-bloodType">Blood Type</th>
                                    <th class = "dashboard-donor-table-header-city">City</th>
                                    <th class = "dashboard-donor-table-header-region">Region</th>
                                    <th class = "dashboard-donor-table-header-date">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- table data -->
                                <?php
                                    $query = "SELECT ID,CreatorID,FirstName,MiddleName,LastName,BloodType,City,Region,Date FROM donortable WHERE Status != 'deleted' ORDER BY Date DESC LIMIT 3";
                                    $result = mysqli_query($con, $query);
                                
                                    //populate data from database
                                    if ($result && mysqli_num_rows($result) > 0)
                                    {
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                            echo "<tr>";
                                            echo "<td class = 'dashboard-donor-table-data-ID'>" . $row['ID'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-creatorID'>" . $row['CreatorID'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-name'>" . $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-bloodType'>" . $row['BloodType'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-city'>" . $row['City'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-region'>" . $row['Region'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-date'>" . $row['Date'] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<div class = 'error-message'>";
                                        echo "<p class = 'error'>No Entries to show</p>";
                                        echo "</div>";
                                    }
                                ?> 
                                </tbody>   
                            </table>
                        </div>
                    </div>
                    <div class = "dashboardNeeder-table" id = "dashboardNeeder-table">
                        <h2>Recent Needed Entry</h2>
                        <div class = "neederTable-container">
                            <table class = "dashboardTable-needer">
                                <!-- table headers -->
                                <thead>
                                <tr>
                                    <th class = "dashboard-donor-table-header-ID">ID</th>
                                    <th class = "dashboard-donor-table-header-creatorID">CreatorID</th>
                                    <th class = "dashboard-donor-table-header-name">Name</th>
                                    <th class = "dashboard-donor-table-header-bloodType">Blood Type</th>
                                    <th class = "dashboard-donor-table-header-city">City</th>
                                    <th class = "dashboard-donor-table-header-region">Region</th>
                                    <th class = "dashboard-donor-table-header-date">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- table data -->
                                <?php
                                    $query = "SELECT ID,CreatorID,FirstName,MiddleName,LastName,BloodType,City,Region,Date FROM needertable WHERE Status != 'deleted' ORDER BY Date DESC LIMIT 3";
                                    $result = mysqli_query($con, $query);
                                
                                    //populate data from database
                                    if ($result && mysqli_num_rows($result) > 0)
                                    {
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                            echo "<tr>";
                                            echo "<td class = 'dashboard-donor-table-data-ID'>" . $row['ID'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-creatorID'>" . $row['CreatorID'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-name'>" . $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-bloodType'>" . $row['BloodType'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-city'>" . $row['City'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-region'>" . $row['Region'] . "</td>";
                                            echo "<td class = 'dashboard-donor-table-data-date'>" . $row['Date'] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<div class = 'error-message'>";
                                        echo "<p class = 'error'>No Entries to show</p>";
                                        echo "</div>";
                                    }
                                    ?>
                                    </tbody>    
                            </table>
                        </div>
                    </div>
                    <div class = "dashboardUser-table" id = "dashboardUser-table">
                        <h2>Most Recent Users Registered</h2>
                        <div class = "userTable-container">
                            <table class = "dashboardTable-user">
                                <!-- table headers -->
                                <thead>
                                <tr>
                                <th class = "dashboard-user-table-header-ID">ID</th>
                                <th class = "dashboard-user-table-header-name">Name</th>
                                <th class = "dashboard-user-table-header-email">Email</th>
                                <th class = "dashboard-user-table-header-phoneNumber">Phone Number</th>
                                <th class = "dashboard-user-table-header-gender">Gender</th>
                                <th class = "dashboard-user-table-header-userName">Username</th>
                                <th class = "dashboard-user-table-header-date">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- table data -->
                                <?php
                                $query = "SELECT ID,FirstName,MiddleName,LastName,Email,PhoneNumber,Gender,Username,Date FROM users WHERE Hidden = 0 ORDER BY Date DESC LIMIT 3";
                                $result = mysqli_query($con, $query);
                                
                                //populate data from database
                                if ($result && mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
                                        echo "<td class = 'dashboard-user-table-data-ID'>" . $row['ID'] . "</td>";
                                        echo "<td class = 'dashboard-user-table-data-name'>" . $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName'] . "</td>";
                                        echo "<td class = 'dashboard-user-table-data-email'>" . $row['Email'] . "</td>";
                                        echo "<td class = 'dashboard-user-table-data-phoneNumber'>" . $row['PhoneNumber'] . "</td>";
                                        echo "<td class = 'dashboard-user-table-data-gender'>" . $row['Gender'] . "</td>";
                                        echo "<td class = 'dashboard-user-table-data-userName'>" . $row['Username'] . "</td>";
                                        echo "<td class = 'dashboard-user-table-data-date'>" . $row['Date'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                else
                                {
                                    echo "<div class = 'error-message'>";
                                    echo "<p class = 'error'>No Entries to show</p>";
                                    echo "</div>";
                                }
                                ?>
                                </tbody>    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</html>