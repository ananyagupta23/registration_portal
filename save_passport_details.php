<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $fatherName = $_POST['father_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $passportCategory = $_POST['category'];
    $passportSubCategory = $_POST['sub_category'];
    $passportFromDate = $_POST['from_date'];
    $passportToDate = $_POST['to_date'];
    $countryVisiting = $_POST['country_visiting'];
    $residentialCard = $_POST['residential_card'];
    // Store data in session
    $_SESSION['passport_details'] = [
        'father_name' => $fatherName,
        'gender' => $gender,
        'age' => $age,
        'category' => $passportCategory,
        'sub_category' => $passportSubCategory,
        'from_date' => $passportFromDate,
        'to_date' => $passportToDate,
        'country_visiting' => $countryVisiting,
        'residential_card' => $residentialCard
    ];
    $userId = $_SESSION['user_id'];
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "intern";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $insertQuery = "INSERT INTO passport_details (user_id, father_name, gender, age, category, sub_category, from_date, to_date, country_visiting, residential_card)
                    VALUES ('$userId', '$fatherName', '$gender', '$age', '$passportCategory', '$passportSubCategory', '$passportFromDate', '$passportToDate', '$countryVisiting', '$residentialCard')";
    if ($conn->query($insertQuery) === TRUE) {
        // Redirect to a success page or any desired location
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
