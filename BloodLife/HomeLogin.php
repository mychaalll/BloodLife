<?php

    session_start();

    include("scripts/connection.php");
    include("scripts/functions.php");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = $_POST['login_username'];
        $password = $_POST['login_password'];

        if(!empty($username) && !empty($password))
        {
            if($username == "admin" && $password == "admin123")
            {
                $_SESSION['status'] = "Welcome, Admin!";
                $_SESSION['status_code'] = "success";
                header("Location:AdminPage/adminDashboard.php");
            }
            $query = "SELECT * from users where UserName = '$username' AND Hidden = 0 limit 1";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0)
            {
                $user_data =  mysqli_fetch_assoc($result);
                
                if($user_data['Password'] === $password)
                {
                    $_SESSION['ID'] = $user_data['ID'];
                    $_SESSION['status'] = "Welcome, " .$user_data['FirstName'] . " " . $user_data['MiddleName'] . " " . $user_data['LastName'] . "!" ;
                    $_SESSION['status_code'] = "success";
                    header("Location: UserPage/userProfile.php");
                    die;
                }
                else
                {
                    $error_msg = "Incorrect Password.";
                }
            }
            else
            {
                $error_msg = "Incorrect Credentials.";
            }
        }
        else
        {
            echo("incomplete details");
        }

    }

?>


<!DOCTYPE html>
<html lang = "en" dir = "ltr">
    <head>
        <title>
            Login Page
        </title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width-device-width, initial-scale">
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@1,500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Zilla+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel = "stylesheet" type = "text/css" href = "styles/HomeStyle.css">
        <!-- <script src = "script.js"></script> -->
    </head>
    <body>
        <section class="homepage">
            <input type="checkbox" id="check">
            <!-- header -->
            <header>
                <nav>
                    <a href="#" class="logo"> <img src="images/Save Lives.png" alt=""> </a>
                    <div class = "navigation">
                        <ul>
                            <li><a href = "index.php">Home</a></li>
                            <li><a href = "HomeAbout.php">About</a></li>
                            <li><a href = "HomeContacts.php">Contacts</a></li>
                            <li><a href = "#">Save a Life Now!</a></li>
                        </ul>
                    </div>
                </nav>
                <label for="check">
                    <i class="fa fa-bars menu-btn"></i>
                    <i class="fa fa-times close-btn"></i>
                </label>
            </header>
            <div class = "content" id = "content">
                <!-- login form -->
                <div class = "login" id = "login">
                    <h1>Login Here</h1>
                    <div class = "error-message">
                        <?php if (isset($error_msg)) { ?>
                        <p class = "error"><i class="fa fa-exclamation-circle"></i><?php echo $error_msg; ?></p>
                        
                        <?php } ?>
                    </div>
                    <form action = "#" method="POST">
                        <p>Username</p>
                        <input type="text" id = "username" name = "login_username" placeholder="Enter Username" required>
                        <P>Password</P>
                        <input type="password" id = "password" name = "login_password" placeholder="Enter Password" required>
                        <input type="submit" id = "loginButton" name = "" onclick = "showHomePage('login','home','about','contact','moreInfo')" value= "Login">
                    </form>
                        
                    <a href="CreatePage/createUser.php"> Dont have an account?</a> 
                </div>
            </div>
        </section>
        <section>
                                        <!--footer-->
            <footer class="media-icons">
                    <h3 class="follow">Follow us in our mission!</h3>
                    <a href = "#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href = "#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href = "#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </footer>
        </section>
    </body>
</html>