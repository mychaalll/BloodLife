<?php
    session_start();
    include("../scripts/connection.php");
    include("../scripts/functions.php");

?>


<!DOCTYPE html>
<html>
    <head>
        <title>
            Admin Users Page
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
        <link rel = "stylesheet" type = "text/css" href = "../styles/adminStyle3.css">
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
                            <li><a href="#">Users</a></li>
                            <li><a href="adminDonors.php">Blood Donors</a></li>
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
                <!-- users page -->
                <div class = "userPage" id = "userPage">
                    <h1>List of Users</h1><br>
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
                            <th class = 'user-table-header-ID'><a href = '?order=ID&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> ID</a></th>
                            <th class = 'user-table-header-name'><a href = '?order=LastName&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Name</a></th>
                            <th class = 'user-table-header-gender'><a href = '?order=Gender&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Gender</a></th>
                            <th class = 'user-table-header-email'><a href = '?order=Email&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Email</a></th>
                            <th class = 'user-table-header-phoneNumber'><a href = '?order=PhoneNumber&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> Phone Number</a></th>
                            <th class = 'user-table-header-date'><a href = '?order=Date&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i>Date</a></th>
                            <th class = 'user-table-header-userName'><a href = '?order=UserName&&sort=$sort' id = 'table-header' ><i class='fa fa-sort' aria-hidden='true'></i> User Name</a></th>
                            <th class = 'user-table-header-password'><t href = '#' id = 'table-header' >Password</t></th>
                            <th class = 'user-table-header-actions'><t href = '#' id = 'table-header' > </t></th>
                            </tr>
                        </thead><tbody>";
                            
                            
                        $query = "SELECT ID,FirstName,MiddleName,LastName,Gender,Email,PhoneNumber,Date,UserName,Password FROM users WHERE Hidden = 0 ORDER BY $order $sort";
                        $result = mysqli_query($con, $query);
                                    
                        //populate data from database
                        if ($result && mysqli_num_rows($result) > 0)
                        {
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                echo "<tr >";
                                echo "<td class = 'user-table-header-ID'>" . $row['ID'] . "</td>";
                                echo "<td class = 'user-table-header-name'>" . $row['LastName'] . ", " . $row['FirstName'] . " " . $row['MiddleName'] . "</td>";
                                echo "<td class = 'user-table-header-gender'>" . $row['Gender'] . "</td>";
                                echo "<td class = 'user-table-header-email'>" . $row['Email'] . "</td>";
                                echo "<td class = 'user-table-header-phonenumber'>" . $row['PhoneNumber'] . "</td>";
                                echo "<td class = 'user-table-header-date'>" . $row['Date'] . "</td>";
                                echo "<td class = 'user-table-header-username'>" . $row['UserName'] . "</td>";
                                echo "<td class = 'user-table-header-password'>" . $row['Password'] . "</td>";
                                echo "<td class = 'user-table-header-actions'>";
                                echo "<div class = 'table-buttons'>";
                                echo "<a class = 'table-edit' href = '../EditPage/editUser.php?id= " .$row['ID'] ."&&from=1'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit</a>";
                                echo "<a class = 'table-delete' href = '../DeleteEntries/deleteUser.php?id= " .$row['ID'] ."&&from=1'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>Delete</a>";
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
        </section>
</html>