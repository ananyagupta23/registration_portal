<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "intern"; // Replace with your actual database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $streetAddress = $_POST['street_address'];
    $postalCode = $_POST['postal_code'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $permanentSameAsAbove = isset($_POST['same_as_above']);
    $permanentStreetAddress = $permanentSameAsAbove ? $streetAddress : $_POST['permanent_street_address'];
    $permanentPostalCode = $permanentSameAsAbove ? $postalCode : $_POST['permanent_postal_code'];
    $permanentCity = $permanentSameAsAbove ? $city : $_POST['permanent_city'];
    $permanentCountry = $permanentSameAsAbove ? $country : $_POST['permanent_country'];
    $emergencyContact = $_POST['emergency_contact'];

    // Store data in session
    $_SESSION['contact_details'] = [
        'street_address' => $streetAddress,
        'postal_code' => $postalCode,
        'city' => $city,
        'country' => $country,
        'permanent_street_address' => $permanentStreetAddress,
        'permanent_postal_code' => $permanentPostalCode,
        'permanent_city' => $permanentCity,
        'permanent_country' => $permanentCountry,
        'emergency_contact' => $emergencyContact
    ];

    // Get the user ID from the session (assuming you stored it after login)
    $userId = $_SESSION['user_id'];

    // Insert data into the database
    $insertQuery = "INSERT INTO contact_details (user_id, street_address, postal_code, city, country, permanent_street_address, permanent_postal_code, permanent_city, permanent_country, emergency_contact)
                    VALUES ('$userId', '$streetAddress', '$postalCode', '$city', '$country', '$permanentStreetAddress', '$permanentPostalCode', '$permanentCity', '$permanentCountry', '$emergencyContact')";

    if ($conn->query($insertQuery) === TRUE) {
        // Redirect back to the main page with anchor for the next section
        header("Location: wel.php#Passport");
        exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

$conn->close();
?>
