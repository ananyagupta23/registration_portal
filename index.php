<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hcll";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['loginForm'])) { // Check if the login form is submitted
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password'";

    $result = $conn->query($sql);

    if ($result->num_rows === 1) { // User found
        // Set session variable for logged-in user
        $_SESSION['username'] = $username;
        
        // Redirect to welcome page after successful login
        header("Location: wel.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}

     elseif (isset($_POST["registrationForm"])) {
        // Handle registration form data
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
 
        // Check if the email is already registered
        $emailExistsQuery = "SELECT * FROM users WHERE email = '$email'";
        $emailExistsResult = $conn->query($emailExistsQuery);

        if ($emailExistsResult->num_rows > 0) {
            $registrationError = "Email already registered. Please choose a different email.";
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
            
            if ($conn->query($sql) === TRUE) {
                // Registration successful
                $_SESSION["email"] = $email;

                // Redirect to welcome page after successful registration
               echo"registered";
                exit();
            } else {
                // Handle registration error
                $registrationError = "Registration failed: " . $conn->error;
            }
        }
    }


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="boxicons/css/boxicons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>HCLTech | Login & Registration</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <img style="margin-top:10px;" src="hcllogo.png" alt="HCLTech logo" width="50%" height="auto">
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link active">Home</a></li>
                <li><a href="#" class="link">Blog</a></li>
                <li><a href="#" class="link">About US</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->

        <div class="login-container" id="login">
            <div class="top">
                <header>Login</header>
            </div>
            <form method="post" action="" name="loginForm">
            <div class="input-box">
                <input type="text" id="email_user" name="uname" class="input-field" placeholder="Username or Email">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" id="user_pass" name="password" class="input-field" placeholder="Password">
                <i class="bx bx-lock-alt"></i>
            </div>
           
            <div>
                <button type="submit"  class="submit" name="loginForm" onclick=" return validateLogin();">Sign In</button>
            </div>
            </form>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check" name="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>

                <div class="two">
                    <label><a href="#">Forgot password?</a></label>
                </div>
            </div>
            <div class="top">
            <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span></div>
        </div>

        <!------------------- registration form -------------------------->
        <div class="register-container" id="register">
            <div class="top">
                <header>Sign Up</header>
            </div>
            <form action="" method="post" name="registrationForm" >
            <div class="two-forms">
               
                <div class="input-box">
                    <input type="text" class="input-field" id="signupfname" name="fname" placeholder="Firstname"required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" id="signuplname"name="lname" placeholder="Lastname">
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" id="signupemail" name="email" placeholder="Email" required>
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" id="signuppass" name="password" placeholder="Password" required>
                <i class="bx bx-lock-alt"></i>
            </div>
            
            <div>
                <button class="submit" name="registrationForm" onclick="return validateRegistration();return register() ">Register</button>
            </div>
        </form>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check" name="register-check">
                    <label for="register-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Terms & conditions</a></label>
                </div>
            </div>
            <div class="top">
                <span>Have an account? <a href="#" onclick="login()">Login</a></span>
        </div>
    </div>
</div>   


<script>
    
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

</script>
<script>
    function validateLogin() {
        var email = document.getElementById("email_user").value;
        var password = document.getElementById("user_pass").value;
        
        if (email === "") {
            alert("Please enter your email or username.");
            return false;
        }
         // Validate email format
         var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.match(emailRegex)) {
            alert("Please enter a valid email address.");
            return false;
        }
        
        if (password === "") {
            alert("Please enter your password.");
            return false;
        }
        
        return true;
    }

    function validateRegistration() {
        var firstname = document.getElementById("signupfname").value;
        var email = document.getElementById("signupemail").value;
        var password = document.getElementById("signuppass").value;
        
        if (firstname === "") {
            alert("Please enter your first name.");
            return false;
        }
        
        if (email === "") {
            alert("Please enter your email.");
            return false;
        }

        // Validate email format
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email.match(emailRegex)) {
            alert("Please enter a valid email address.");
            return false;
        }
        
        if (password === "") {
            alert("Please enter a password.");
            return false;
        }

        // Validate password strength (at least 8 characters with a mix of letters and numbers)
        var passwordRegex = /^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/;
        if (!password.match(passwordRegex)) {
            alert("Password must be at least 8 characters long and contain both letters and numbers.");
            return false;
        }
        
        return true;
    }

   
    function registered() {
        if (validateRegistration()) {
            alert("Registered successfully");
        }
    }
</script>

</body>
</html>