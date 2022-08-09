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
            Needer Entries
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
        <link rel = "stylesheet" type = "text/css" href = "../styles/userStyle2.css">
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
                            <li> <a class="pro" href = "userProfile.php">Profile</a></li>
                            <li> <a href = "userDonors.php">Blood Donors</a></li>
                            <li> <a class="sbn" href = "#">Blood Recipients</a></li>
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
                <!-- Needer Page -->
                <div class = "donorPage" id = "bloodNeederPage">
                <h1>Blood Recipient Entries</h1>
                <!-- compose button -->
                <div class = "href-cont">
                    <a href = "../CreatePage/createEntryNeeder.php" class = "composeEntry">Compose an entry</a>
                </div>
                    <div class = "donor-table">
                        <div class = "userTable-container">
                            <table class = "userTables">
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
                                    <th class = 'donor-table-header-name'><a href = '?order=LastName&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i>Name</a></th>
                                    <th class = 'donor-table-header-bloodType'><a href = '?order=BloodType&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i>Blood Type</a></th>
                                    <th class = 'donor-table-header-city'><a href = '?order=City&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i>City</a></th>
                                    <th class = 'donor-table-header-region'><a href = '?order=Region&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i>Region</a></th>
                                    <th class = 'donor-table-header-date'><a href = '?order=Date&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Date</a></th>
                                    <th class = 'donor-table-header-actions'><a href = '#' id = 'table-header' ></a></th>
                                    </tr>
                                </thead><tbody>";
                                    
                                    
                                $query = "SELECT ID,FirstName,MiddleName,LastName,BloodType,FullAddress,City,Region,ContactDetails,Comments,Date FROM needertable WHERE Status != 'deleted' ORDER BY $order $sort";
                                $result = mysqli_query($con, $query);
                                            
                                //populate data from database
                                if ($result && mysqli_num_rows($result) > 0)
                                {
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr >";
                                        echo "<td class = 'donor-table-header-name'>" . $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MiddleName'] . "</td>";
                                        echo "<td class = 'donor-table-header-bloodType'>" . $row['BloodType'] . "</td>";
                                        echo "<td class = 'donor-table-header-city'>" . $row['City'] . "</td>";
                                        echo "<td class = 'donor-table-header-region'>" . $row['Region'] . "</td>";
                                        echo "<td class = 'donor-table-header-date'>" . $row['Date'] . "</td>";
                                        echo "<td class = 'donor-table-header-actions'>";
                                        echo "<div class = 'table-buttons'>";
                                        echo "<a class = 'table-see-details' href = '../ShowPage/neederDetail.php?id= " .$row['ID'] ."'><i class='fa fa-info-circle' aria-hidden='true'></i>See Details</a>";
                                        echo "<a class = 'table-delete' href = '../ReportPage/reportNeeder.php?id= " .$row['ID'] ."&&from=0'><i class='fa fa-flag-o' aria-hidden='true'></i>Report</a>";
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
    </body>
</html>