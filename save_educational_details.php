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
    $educationType = $_POST['education_type'];
    $category = $_POST['category'];
    $subCategory = $_POST['sub_category'];
    $fromDate = $_POST['from_date'];
    $toDate = $_POST['to_date'];

    // Store data in session
    $_SESSION['educational_details'] = [
        'education_type' => $educationType,
        'category' => $category,
        'sub_category' => $subCategory,
        'from_date' => $fromDate,
        'to_date' => $toDate
    ];

    // Insert data into the database
    $insertQuery = "INSERT INTO educational_details (education_type, category, sub_category, from_date, to_date)
                    VALUES ('$educationType', '$category', '$subCategory', '$fromDate', '$toDate')";

    if ($conn->query($insertQuery) === TRUE) {
        // Redirect back to the main page with anchor for the next section
        header("Location: wel.php#Experience");
        exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

$conn->close();
?>
