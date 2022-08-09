<!DOCTYPE html>
<html lang = "en" dir = "ltr">
    <head>
        <title>
            BloodLife
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
        <link rel = "stylesheet" href = "styles/HomeStyle.css">
        <!-- <script src = "script.js"></script> -->
    </head>
    <body>
        <section class="homepage">
            <input type="checkbox" id="check">
            <!-- header -->
            <header>
                <nav>
                    <a href="#"> <img class="logo" src="images/Save Lives.png" alt=""></a>
                    <div class = "navigation">
                        <ul>
                            <li class="home"><a href = "#">Home</a></li>
                            <li class="abt"><a href = "HomeAbout.php">About</a></li>
                            <li class="ctc"><a href = "HomeContacts.php">Contacts</a></li>
                            <li class="saln"><a href = "HomeLogin.php">Save a Life Now!</a></li>
                        </ul>
                    </div>
                </nav>
                <label for="check">
                    <i class="fa fa-bars menu-btn"></i>
                    <i class="fa fa-times close-btn"></i>
                </label>
            </header>
            <div class = "content" id = "content">
                <!-- info form -->
                <div class = "info" id = "home">
                    <h2>GIVE Blood.<br><span>GIVE Life.</span></h2>
                    <p>"Donate your blood for a reason, let the reason to be life."</p>
                    <a href = "HomeMoreInfo.php" class = "info-btn">More Info</a>
                    <img src="images/arrow.png" alt=""> 
                </div>              
            </div>
        </section>
        <!------- FOOTER -------->
            <footer class="media-icons">
            <h3 class="follow">Follow us in our mission!</h3>
                <a href = "#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href = "#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href = "#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </footer> 
    </body>
</html>