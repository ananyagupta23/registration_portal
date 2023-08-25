<?php
session_start(); 
if (isset($login_successful)) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>My Form</title> 
   <link rel="stylesheet" href="nav.css">
</head>
<body>
<h4>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>!</h4>

<div class="logout-btn">
<form action="logout.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>
    <div class="section" id="Personal">
    <center><h1>Personal Details</h1></center>
    <form action="save_personal_details.php" method="post">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required><br><br>

        <label for="middlename">Middle Name:</label>
        <input type="text" id="middlename" name="middlename"><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required><br><br>

        <label for="contact">Contact:</label>
        <input type="number" id="contact" name="contact" required><br><br>

        <label for="doj">Date of Joining:</label>
        <input type="date" id="doj" name="doj" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="nationality">Nationality:</label>
        <input type="radio" id="indian" name="nationality" value="Indian" required>
        <label for="indian">Indian</label>
        <input type="radio" id="nonindian" name="nationality" value="Non-Indian">
        <label for="nonindian">Non-Indian</label><br><br>

        <button type="submit" onclick="return validatePersonalSection();">Save</button>
        <button type="button" onclick="showSection('Educational')">Next</button>
    </form>
    </div>
   

    <div class="section" id="Educational">
        <center><h1>Educational Details</h1></center>
        <form action="save_educational_details.php" method="post">
            <input type="radio" id="university" name="education_type" value="University">
            <label for="university">University</label>
            <input type="radio" id="college" name="education_type" value="College">
            <label for="college">College</label>
            <input type="radio" id="school" name="education_type" value="School">
            <label for="school">School</label><br><br>

            <label for="category">Branch:</label>
            <input type="text" id="category" name="category" required><br><br>
    
            <label for="sub-category">Course:</label>
            <input type="text" id="sub-category" name="sub_category"><br><br>
    
            <label for="from-date">From:</label>
            <input type="date" id="from-date" name="from_date" required><br><br>
    
            <label for="to-date">To:</label>
            <input type="date" id="to-date" name="to_date" required><br><br>
            <button type="button" onclick="showSection('Personal')">Previous</button>
            <button type="submit" onclick="return validateEducationalSection();">Save</button>
            <button type="button" onclick="showSection('Experience')">Next</button>
        </form>
    </div>
    

    <div class="section" id="Experience">
        <center><h1>Experience Details</h1></center>
        <form action="save_experience_details.php" method="post">
            <label for="from_date">From:</label>
            <input type="date" id="from_date" name="from_date"><br><br>
    
            <label for="to_date">To:</label>
            <input type="date" id="to_date" name="to_date"><br><br>
    
            <label for="org">Organization:</label>
            <input type="text" id="org" name="organization"><br><br>
    
            <label for="des">Designation:</label>
            <input type="text" id="des" name="designation"><br><br>
    
            <label for="city">City:</label>
            <input type="text" id="city" name="city"><br><br>
    
            <button type="button" onclick="showSection('Educational')">Previous</button>
            <button type="submit" onclick="return validateExperienceSection();">Save</button>
            <button type="button" onclick="showSection('Contact')">Next</button>
        </form>
    </div>
    

    <div class="section" id="Contact">
        <center><h1>Contact Details</h1></center>
        <form action="save_contact_details.php" method="post">
            <label for="street_address">Street Address:</label>
            <input type="text" id="street_address" name="street_address"><br><br>
    
            <label for="postal_code">ZIP:</label>
            <input type="text" id="postal_code" name="postal_code"><br><br>
    
            <label for="city">City:</label>
            <input type="text" id="city" name="city"><br><br>
    
            <label for="country">Country:</label>
            <input type="text" id="country" name="country"><br><br>
    
            <input type="checkbox" id="same_as_above" onclick="copyAddress()">
            <label for="same_as_above">Same as Above</label><br><br>
    
            <h3>Permanent Address</h3>
            <label for="permanent_street_address">Street Address:</label>
            <input type="text" id="permanent_street_address" name="permanent_street_address"><br><br>
    
            <label for="permanent_postal_code">ZIP:</label>
            <input type="text" id="permanent_postal_code" name="permanent_postal_code"><br><br>
    
            <label for="permanent_city">City:</label>
            <input type="text" id="permanent_city" name="permanent_city"><br><br>
    
            <label for="permanent_country">Country:</label>
            <input type="text" id="permanent_country" name="permanent_country"><br><br>
    
            <label for="emergency_contact">Emergency Contact Number:</label>
            <input type="text" id="emergency_contact" name="emergency_contact"><br><br>
    
            <button type="button" onclick="showSection('Experience')">Previous</button>
            <button type="submit" onclick="return validateContactSection() ;">Save</button>
            <button type="button" onclick="showSection('Passport')">Next</button>
        </form>
    </div>
    <div class="section" id="Passport">
        <center><h1>Passport Details</h1></center>
        <form action="save_passport_details.php" method="post" onsubmit="return validateForm();">
            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name"><br><br>
    
            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="Male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="Female">
            <label for="female">Female</label>
            <input type="radio" id="other" name="gender" value="Other">
            <label for="other">Other</label><br><br>
    
            <label for="age">Age:</label>
            <input type="number" id="age" name="age"><br><br>
    
            <label for="category">Category:</label>
            <input type="text" id="category" name="category"><br><br>
    
            <label for="sub_category">Sub-Category:</label>
            <input type="text" id="sub_category" name="sub_category"><br><br>
    
            <label for="from_date">From:</label>
            <input type="date" id="from_date" name="from_date"><br><br>
    
            <label for="to_date">To:</label>
            <input type="date" id="to_date" name="to_date"><br><br>
    
            <label for="country_visiting">Country Visiting:</label>
            <input type="text" id="country_visiting" name="country_visiting"><br><br>
    
            <h3>Residential Card</h3>
            <input type="radio" id="yellow_card" name="residential_card" value="Yellow Card">
            <label for="yellow_card">Yellow Card</label>
            <input type="radio" id="green_card" name="residential_card" value="Green Card">
            <label for="green_card">Green Card</label>
            <input type="radio" id="red_card" name="residential_card" value="Red Card">
            <label for="red_card">Red Card</label><br><br>
    
            <button type="button" onclick="showSection('Contact')">Previous</button>
            <button type="submit" onclick="return validatePassportSection();">Save</button>
        </form>
    </div>

<script src="script.js"></script>
</body>
</html>
