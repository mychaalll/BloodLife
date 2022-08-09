<?php
    //get logged in user credentials
    function check_login($con)
    {

        if(isset($_SESSION['ID']))
        {
            $id = $_SESSION['ID'];
            $query = "select * from users where ID = '$id' limit 1";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }

        //redirect to login
        header("Location: index.php");
        die;
    }

    function userStatistics($con)
    {
        $query = "SELECT ID FROM users";
        
        $count = mysqli_query($con, $query);

        $userCount = mysqli_num_rows($count);        

        return $userCount;
    
    }
    function donorStatistics($con)
    {
        $query = "SELECT ID FROM donortable";
        
        $count = mysqli_query($con, $query);

        $donorCount = mysqli_num_rows($count);        

        return $donorCount;
    
    }
    function neederStatistics($con)
    {
        $query = "SELECT ID FROM needertable";
        
        $count = mysqli_query($con, $query);

        $neederCount = mysqli_num_rows($count);

        return $neederCount;
    }
?>
<!-- ALERT ENTRY -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] != '')
    {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function(event){
                swal({
                    title: "<?php echo $_SESSION['status']; ?>",
                    icon:  "<?php echo $_SESSION['status_code']; ?>",
                    button:  "Close",
                });
            })
        </script>
    <?php
        unset($_SESSION['status']);
    }
?>