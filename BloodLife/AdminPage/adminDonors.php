<?php
    session_start();
    include("../scripts/connection.php");
    include("../scripts/functions.php");


?>


<!DOCTYPE html>
<html>
    <head>
        <title>
            Admin Donor Page
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
        <link rel = "stylesheet" type = "text/css" href = "../styles/adminStyle1.css">
        <script src = "script.js"></script>
    </head>
    <body>
        <section>
            <input type="checkbox" id="check">
            <!-- header -->
            <header>
                <nav>
                    <h2>
                        <a href = "#"><img src="../images/Save Lives.png" alt=""></a>
                    </h2>
                    <!-- buttons at top right -->
                    <div class = "navigation">
                        <ul>
                            <li><a class = "pro" href = "adminDashboard.php">Dashboard</a></li>
                            <li><a href="adminReport.php">Reported</a></li>
                            <li><a href="adminUsers.php">Users</a></li>
                            <li><a href="#">Blood Donors</a></li>
                            <li><a class ="sbn" href="adminNeeders.php">Blood Recipient</a></li>
                            <a class="logout" id = "button" href="../index.php">Logout</a>
                        </ul>
                    </div>
                </nav>
                <label for="check">
                    <i class="fa fa-bars menu-btn"></i>
                    <i class="fa fa-times close-btn"></i>
                </label>
            </header>
            <div class = "content" id = "content">
                <!-- admin form -->
                <div class = "bloodDonorPage" id = "bloodDonorPage" >
                    <h1>Table of Blood Donors</h1><br>
                    <table class = "adminTables">
                        <?php
                        //getting the table order
                        if (isset($_GET['order']))
                        {
                            $order = $_GET['order'];
                        }
                        else
                        {
                            $order = 'ID';
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
                            <th class = 'donor-table-header-ID'><a href = '?order=ID&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> ID</a></th>
                            <th class = 'donor-table-header-creatorID'><a href = '?order=CreatorID&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Creator ID</a></th>
                            <th class = 'donor-table-header-name'><a href = '?order=LastName&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Name</a></th>
                            <th class = 'donor-table-header-bloodType'><a class = 'bt' href = '?order=BloodType&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Blood Type</a></th>
                            <th class = 'donor-table-header-city'><a href = '?order=City&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> City</a></th>
                            <th class = 'donor-table-header-region'><a href = '?order=Region&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Region</a></th>
                            <th class = 'donor-table-header-contactDetails'><a href = '?order=ContactDetails&&sort=$sort' id = 'table-header' class = 'contact'><i class='fa fa-sort' aria-hidden='true'></i> Contact Details</a></th>
                            <th class = 'donor-table-header-date'><a href = '?order=Date&&sort=$sort' id = 'table-header' class = 'date'><i class='fa fa-sort' aria-hidden='true'></i>Date</a></th>
                            <th class = 'donor-table-header-comments'><p href = '#' id = 'table-header' class = 'comments' >Comments</p></th>
                            <th class = 'donor-table-header-actions'><t href = '#' id = 'table-header' ></t></th>
                            </tr>
                        </thead><tbody>";
                            
                            
                        $query = "SELECT ID,CreatorID,FirstName,MiddleName,LastName,BloodType,FullAddress,City,Region,ContactDetails,Date,Comments FROM donortable WHERE Status != 'deleted' ORDER BY $order $sort";
                        $result = mysqli_query($con, $query);
                                    
                        //populate data from database
                        if ($result && mysqli_num_rows($result) > 0)
                        {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                echo "<tr >";
                                echo "<td class = 'donor-table-header-ID'>" . $row['ID'] . "</td>";
                                echo "<td class = 'donor-table-header-CreatorID'>" . $row['CreatorID'] . "</td>";
                                echo "<td class = 'donor-table-header-name'>" . $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MiddleName'] . "</td>";
                                echo "<td class = 'donor-table-header-bloodType'>" . $row['BloodType'] . "</td>";
                                echo "<td class = 'donor-table-header-city'>" . $row['City'] . "</td>";
                                echo "<td class = 'donor-table-header-region'>" . $row['Region'] . "</td>";
                                echo "<td class = 'donor-table-header-contactDetails'>" . $row['ContactDetails'] . "</td>";
                                echo "<td class = 'donor-table-header-region'>" . $row['Date'] . "</td>";
                                echo "<td class = 'donor-table-header-comments'>" . $row['Comments'] . "</td>";
                                echo "<td class = 'donor-table-header-actions'>";
                                echo "<div class = 'table-buttons'>";
                                echo "<a class = 'table-edit' href = '../EditPage/editBloodDonor.php?id= " .$row['ID'] ."&& from=1'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit</a>";
                                echo "<a class = 'table-delete' href = '../DeleteEntries/deleteDonor.php?id= " .$row['ID'] ."&& from=1'><i class='fa fa-trash-o' aria-hidden='true'></i>Delete</a>";
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
                        echo "</tbody";    
                        ?>     
                    </table>
                </div>
            </div>
        </section>
</html>