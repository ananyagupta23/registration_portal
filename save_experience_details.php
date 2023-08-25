<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intern";
// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $fromDate = $_POST['from_date'];
    $toDate = $_POST['to_date'];
    $organization = $_POST['organization'];
    $designation = $_POST['designation'];
    $city = $_POST['city'];

    // Store data in session
    $_SESSION['experience_details'] = [
        'from_date' => $fromDate,
        'to_date' => $toDate,
        'organization' => $organization,
        'designation' => $designation,
        'city' => $city
    ];

    // Get user ID from session (assuming it's stored after successful login)
    $userId = $_SESSION['user_id'];

    // Insert data into the database
    $insertQuery = "INSERT INTO experience_details (user_id, from_date, to_date, organization, designation, city)
                    VALUES ('$userId', '$fromDate', '$toDate', '$organization', '$designation', '$city')";

    if ($conn->query($insertQuery) === TRUE) {
        // Redirect back to the main page with anchor for the next section
        header("Location: wel.php#Contact");
        exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

$conn->close();
?>
