<?php
// Include your database connection file
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect post data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $officeNumber = $_POST['office_number'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact (contact_name, contact_email, contact_onum) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $officeNumber);

    // Execute and check for success
    if ($stmt->execute()) {
        // Redirect to controlPanelhtml.php section 3 with an alert
        echo "<script>alert('Contact has been added'); window.location.href='controlPanelhtml.php#section-3';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
