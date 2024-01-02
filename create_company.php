<?php
// Include database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cname = $_POST['company-name'];
    $cfield = $_POST['workField'];
    $cwebsite = $_POST['Website'];
    $ccountry = $_POST['country']; // Assuming this is for the country
    $cwork_to_be_done = $_POST['description'];
    $cphone = $_POST['phone-number'];
    $cemail = $_POST['email'];
    $cfax = $_POST['Fax'];
    $cduration = $_POST['duration'];
    $caddress = $_POST['address']; // Address textarea
    $csfname = $_POST['first-name'];
    $cslname = $_POST['last-name'];
    $csemail = $_POST['sup-email'];
    $csposition = $_POST['supPosition'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO company (cname, cfeild, cwebsite, ccountry, cwork_to_be_done, cphone, cemail, cfax, cduration, caddress, csfname, cslname, csemail, csposition) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $cname, $cfield, $cwebsite, $ccountry, $cwork_to_be_done, $cphone, $cemail, $cfax, $cduration, $caddress, $csfname, $cslname, $csemail, $csposition);

    if ($stmt->execute()) {
        // JavaScript for alert and redirection
        echo "<script type='text/javascript'>";
        echo "alert('Company has been added successfully');";
        echo "window.location = 'controlPanelhtml.php#section9';";
        echo "</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Invalid request";
}

// Close connection
$conn->close();
?>