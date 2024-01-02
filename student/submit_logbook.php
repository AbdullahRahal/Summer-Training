<?php
// Start the session
session_start();

// Include the database connection file
require_once 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch student information from the session
    $studentName = $_SESSION['student_name'];
    $studentEmail = $_SESSION['username'];
    $studentNumber = $_SESSION['student_number'];
    $studentSemester = $_SESSION['student_semester'];

    // Get form data
    $date = $_POST['date'];
    $department = $_POST['department'];
    $description = $_POST['description'];

    // Get the day of the week
    $dayOfWeek = date('l', strtotime($date));

    // Prepare SQL query
    $query = "INSERT INTO logbooks (std_num, std_name, book_date, book_department, book_Description, book_day) 
              VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $studentNumber, $studentName, $date, $department, $description, $dayOfWeek);

    // Execute the query and redirect
    if ($stmt->execute()) {
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Redirect with success message
        header('Location: logbookhtml.php?success=1');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
