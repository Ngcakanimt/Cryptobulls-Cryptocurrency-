<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>

     <!--This is for the icon to appear on the tab-->
     <link rel="shortcut icon" href="assets/Images/logo.png" type="image/x-icon">

     <!--This is for the icons in boxicons-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
 
     <!--CSS stylesheet-->
     <link rel="stylesheet" href="css/signup.css">
</head>

<header class="header" id="header">
    <a href="" class="nav_logo">
        <img src="assets/Images/CryptoBulls logo.svg" alt="Cryptobulls logo">
    </a>

    <div class="moon">
        <i class='bx bx-moon bx-md'></i>
        <button class="darkmode">
            <i class='bx bxs-moon bx-md' style='color:#f9e000'></i>
        </button>
    </div> 
    
</header>
<hr>
<body>

    <?php
        
        // Define variables and initialize with empty values
        $name = $surname = $username = $password = $confirm_password = "";
        $name_err = $surname_err = $username_err = $password_err = $confirm_password_err = "";

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            //Get input from form
            $name = $_POST['Name'];
            $surname = $_POST['Surname'];
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            $confirm_password = $_POST['Confirm_password'];
            
            // Include config file
            require_once "config.php";

            //connect to database
            $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die("Unable to connect to database");

            //get and store username and password for checking if they are already taken
            $sql_username = "SELECT * FROM users WHERE username = $username"; 
            $sql_password = "SELECT * FROM users WHERE password = $password"; 
            $username_res = mysqli_query($conn, $sql_username) or die("couldn't get username");
            $password_res = mysqli_query($conn, $sql_password) or die("couldn't get password");

            //checks if name field is empty
            if(empty(trim($_POST['Name']))) {
                $name_err = "Please enter your name";
            }

            //checks if surname field is empty
            elseif(empty(trim($_POST['Surname']))) {
                
                $surname_err = "Please enter your surname";
            }
            //checks if username field is empty
            elseif(empty(trim($_POST['Username']))) {
                $username_err = "Please enter your username";
            }
            //checks if username is taken
            elseif(mysqli_num_rows($username_res) > 0) {
                $username_err = "Sorry, this username is already taken";
            }
            //checks if username is in the correct format
            elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
                $username_err = "Username can only contain letters, numbers, and underscores.";
            }

            //Check if password field is taken
            elseif(empty(trim($_POST['Password']))) {
                $password_err = "Please enter your password";
            }
            //checks if password is the same as confirm password
            elseif($password != $confirm_password) {
                $confirm_password_err = "Passwords are not the same. Please try again";
            }
            else {
                $query = "INSERT INTO `users`(`name`, `surname`, `username`, `password`)
                        VALUES('$name', '$surname', '$username', '$password')";
                $result = mysqli_query($conn, $query) or die("Unable to signup");
                header("location:congrats.html");
            }
            mysqli_close($conn);
        }    
    ?>        

    <img src="assets/Images/wave2.svg" alt="wave" class="wave">
    <div class="signup_page">
        <div class="signup_container" id="signup_container">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <img src="assets/Images/undraw_profile_pic_ic5t.svg" alt="profile pic" class="avatar">
                <h2>Welcome</h2>
                <div class="input_div one">
                    <div class="i">
                        <i class='bx bxs-user bx-sm'></i>
                    </div>
                    <div>
                        <h5>Name</h5>
                        <input type="text" class="input" name="Name" id="input">
                    </div>
                </div>
                <span class="invalid">
                    <?php echo $name_err;?>
                </span>
                <div class="input_div two">
                    <div class="i">
                        <i class='bx bxs-user bx-sm'></i>
                    </div>
                    <div>
                        <h5>Surname</h5>
                        <input type="text" class="input" name="Surname" id="input">
                    </div>
                </div>
                <span class="invalid">
                    <?php echo $surname_err;?>
                </span>
                <div class="input_div three">
                    <div class="i">
                        <i class='bx bxs-user-check bx-sm'></i>
                    </div>
                    <div>
                        <h5>Username</h5>
                        <input type="text" class="input" name="Username" id="input">
                        
                    </div>
                </div>
                <span class="invalid">
                        <?php echo $username_err;?>
                    </span>
                <div class="input_div four">
                    <div class="i">
                        <i class='bx bxs-lock-alt bx-sm'></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input type="password" class="input" name="Password" id="input">
                        
                    </div>
                </div>
                <span class="invalid">
                    <?php echo $password_err;?>
                </span>
                <div class="input_div five">
                    <div class="i">
                        <i class='bx bxs-lock-alt bx-sm'></i>
                    </div>
                    <div>
                        <h5>Confirm Password</h5>
                        <input type="password" class="input" name="Confirm_password" id="input">
                        
                    </div>
                    
                </div>
                <span class="invalid">
                    <?php echo $confirm_password_err;?>
                </span>
                <a href="#" class="signup">Already have an account? Login here</a>
                <input type="submit" value="Sign up" class="signup_btn" name="signup">
            </form>
        </div>
        <div class="image_container" id="image_container">
            <div class="img">
                <img src="assets/Images/undraw_mobile_user_7oqo.svg" alt="user">
            </div>
        </div>
    </div>


<script src="javascript/signup.js"></script>

<script>
    window.onload = function() {
        document.getElementById('input').value = '';
    }
</script>
</body>
</html>