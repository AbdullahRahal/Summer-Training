<?php
session_start(); // Start the session at the very beginning
var_dump($_POST);
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db_connect.php'; // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $cs_name = mysqli_real_escape_string($conn, $_POST['sup_name']);
    $cs_email = mysqli_real_escape_string($conn, $_POST['email']);
    $cs_password = password_hash($_POST['sup_pwd'], PASSWORD_DEFAULT); // Hash the password
    $cs_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $cs_company_name = mysqli_real_escape_string($conn, $_POST['sup_com']);
    $cs_position = mysqli_real_escape_string($conn, $_POST['position']);

    // SQL query to insert data into the company_cs table
    $query = "INSERT INTO company_cs (cs_name, cs_email, cs_password, cs_phone, cs_company_name, cs_position) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $cs_name, $cs_email, $cs_password, $cs_phone, $cs_company_name, $cs_position);

    // Execute and check for success
    if ($stmt->execute()) {
        header("Location: controlPanelhtml.php?registrationcs=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
