<?php
session_start();

if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect back to the login page or any other desired page
    header("Location: logout.php"); // Replace "login.php" with your actual login page URL
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Logout</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Logout</h4>
            </div>
            <div class="card-body">
                <p>You have been successfully logged out.</p>
                <a href="index.php" class="btn btn-primary">Login again</a>
            </div>
        </div>
    </div>
</body>
</html>
