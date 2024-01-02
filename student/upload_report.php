<?php
session_start();
include 'db_connect.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

// Variables from the session
$studentName = $_SESSION['student_name'];
$studentNumber = $_SESSION['student_number'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file is uploaded
    if (isset($_FILES['reportFile']) && $_FILES['reportFile']['error'] == 0) {
        // You can add more validations for file type, size, etc. here

        $fileName = $_FILES['reportFile']['name'];
        $fileTmpName = $_FILES['reportFile']['tmp_name'];
        $fileDestination = 'uploads/' . $fileName; // Ensure this directory exists and is writable

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
            // Fetch student department from database
            $query = "SELECT std_department FROM students WHERE std_num = ? AND std_name = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $studentNumber, $studentName);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $studentDepartment = $row['std_department'] ?? 'Not Found';

            // Insert report information into database
            $insertQuery = "INSERT INTO reports (std_name, std_num, std_department, report_file) VALUES (?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("ssss", $studentName, $studentNumber, $studentDepartment, $fileDestination);
            $insertStmt->execute();

            if ($insertStmt->affected_rows > 0) {
                echo "Report uploaded successfully";
            } else {
                echo "Error uploading report";
            }
        } else {
            echo "Error uploading file";
        }
    } else {
        echo "No file uploaded";
    }
} else {
    echo "Invalid request";
}
?>
