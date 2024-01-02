<?php
session_start();
include 'db_connect.php'; // Path to your db_connect.php file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user info from session
    $csName = $_SESSION['cs_name'];
    $csEmail = $_SESSION['username'];

    // Retrieve form data
    $eva1 = $_POST['interest'];
    $eva2 = $_POST['attendance'];
    $eva3 = $_POST['Technical'];
    $eva4 = $_POST['generalbehavior'];
    $eva5 = $_POST['overall'];
    $summary = $_POST['summary_of_work_done'];
    $comment = $_POST['comments'];

    // Prepare SQL to fetch student data
    $stmt = $conn->prepare("SELECT std_name, std_num FROM students WHERE cs_name = ? AND cs_email = ?");
    $stmt->bind_param("ss", $csName, $csEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    // Check if student data is found
    if ($student) {
        // Prepare SQL to insert evaluation data
        $insertStmt = $conn->prepare("INSERT INTO logbooks_eva (std_num, cs_name, cs_email, std_name, eva1, eva2, eva3, eva4, eva5, summary, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssssssssss", $student['std_num'], $csName, $csEmail, $student['std_name'], $eva1, $eva2, $eva3, $eva4, $eva5, $summary, $comment);

        // Execute and check if insertion is successful
        if ($insertStmt->execute()) {
            echo "Evaluation submitted successfully.";
        } else {
            echo "Error submitting evaluation: " . $conn->error;
        }
    } else {
        echo "Student data not found.";
    }
} else {
    echo "Invalid request method.";
}
?>
