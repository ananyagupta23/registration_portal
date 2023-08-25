<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intern";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $contact = $_POST['contact'];
    $doj = $_POST['doj'];
    $email = $_POST['email'];
    $nationality = $_POST['nationality'];

    // Store data in session
    $_SESSION['personal_details'] = [
        'firstname' => $firstname,
        'middlename' => $middlename,
        'lastname' => $lastname,
        'contact' => $contact,
        'doj' => $doj,
        'email' => $email,
        'nationality' => $nationality
    ];
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $firstname = $_SESSION['personal_details']['firstname'];
    $middlename = $_SESSION['personal_details']['middlename'];
    $lastname = $_SESSION['personal_details']['lastname'];
    $contact = $_SESSION['personal_details']['contact'];
    $doj = $_SESSION['personal_details']['doj'];
    $email = $_SESSION['personal_details']['email'];
    $nationality = $_SESSION['personal_details']['nationality'];
    
    $sql = "INSERT INTO personal_details (firstname, middlename, lastname, contact, doj, email, nationality)
            VALUES ('$firstname', '$middlename', '$lastname', '$contact', '$doj', '$email', '$nationality')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: wel.php#Edu");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

 
?>
