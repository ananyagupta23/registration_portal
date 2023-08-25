function validatePersonalSection() {
    var firstname = document.getElementById("firstname").value.trim();
    var lastname = document.getElementById("lastname").value.trim();
    var contact = document.getElementById("contact").value.trim();
    var doj = document.getElementById("doj").value.trim();
    var email = document.getElementById("email").value.trim();

    if (firstname === "" || lastname === "" || contact === "" || doj === "" || email === "") {
        alert("All fields in Personal Details section are required.");
        return false;
    }
    return true;
}
function validateEducationalSection() {
    var educationType = document.querySelector('input[name="education_type"]:checked');
    var category = document.getElementById("category").value.trim();
    var fromDate = document.getElementById("from-date").value.trim();
    var toDate = document.getElementById("to-date").value.trim();

    if (!educationType) {
        alert("Please select an education type.");
        return false;
    }

    if (category === "" || fromDate === "" || toDate === "") {
        alert("All fields in Educational Details section are required.");
        return false;
    }

    // Additional validation checks for fromDate and toDate can be added here

    return true;
}

function validateExperienceSection() {
    var fromDate = document.getElementById("from_date").value.trim();
    var toDate = document.getElementById("to_date").value.trim();
    var organization = document.getElementById("org").value.trim();
    var designation = document.getElementById("des").value.trim();
    var city = document.getElementById("city").value.trim();

    if (fromDate === "" || toDate === "" || organization === "" || designation === "" || city === "") {
        alert("All fields in Experience Details section are required.");
        return false;
    }

    // Additional validation checks for fromDate and toDate can be added here

    return true;
}

function validateContactSection() {
    var streetAddress = document.getElementById("street_address").value.trim();
    var postalCode = document.getElementById("postal_code").value.trim();
    var city = document.getElementById("city").value.trim();
    var country = document.getElementById("country").value.trim();
    var permanentSameAsAbove = document.getElementById("same_as_above").checked;
    var permanentStreetAddress = document.getElementById("permanent_street_address").value.trim();
    var permanentPostalCode = document.getElementById("permanent_postal_code").value.trim();
    var permanentCity = document.getElementById("permanent_city").value.trim();
    var permanentCountry = document.getElementById("permanent_country").value.trim();
    var emergencyContact = document.getElementById("emergency_contact").value.trim();

    if (streetAddress === "" || postalCode === "" || city === "" || country === "" ||
        (!permanentSameAsAbove && (permanentStreetAddress === "" || permanentPostalCode === "" ||
        permanentCity === "" || permanentCountry === "")) || emergencyContact === "") {
        alert("All fields in Contact Details section are required.");
        return false;
    }

    // Additional validation checks for postalCode and emergencyContact can be added here

    return true;
}

function validatePassportSection() {
    var fatherName = document.getElementById("father_name").value.trim();
    var gender = document.querySelector('input[name="gender"]:checked');
    var age = document.getElementById("age").value.trim();
    var category = document.getElementById("category").value.trim();
    var subCategory = document.getElementById("sub_category").value.trim();
    var fromDate = document.getElementById("from_date").value.trim();
    var toDate = document.getElementById("to_date").value.trim();
    var countryVisiting = document.getElementById("country_visiting").value.trim();
    var residentialCard = document.querySelector('input[name="residential_card"]:checked');

    if (fatherName === "" || !gender || age === "" || category === "" || subCategory === "" ||
        fromDate === "" || toDate === "" || countryVisiting === "" || !residentialCard) {
        alert("All fields in Passport Details section are required.");
        return false;
    }

    // Additional validation checks for age, fromDate, toDate, and other fields can be added here

    return true;
}

function validateForm() {
    if (!validatePersonalSection()) {
        return false;
    }

    if (!validateEducationalSection()) {
        return false;
    }

    if (!validateExperienceSection()) {
        return false;
    }

    if (!validateContactSection()) {
        return false;
    }

    if (!validatePassportSection()) {
        return false;
    }

    return true;
}
function showSection(sectionId) {
    // Hide all sections
    var sections = document.getElementsByClassName('section');
    for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = 'none';
    }

    // Show the selected section
    document.getElementById(sectionId).style.display = 'block';
}


function copyAddress() {
    if (document.getElementById('same_as_above').checked) {
        document.getElementById('permanent_street_address').value = document.getElementById('street_address').value;
        document.getElementById('permanent_postal_code').value = document.getElementById('postal_code').value;
        document.getElementById('permanent_city').value = document.getElementById('city').value;
        document.getElementById('permanent_country').value = document.getElementById('country').value;
    }
}