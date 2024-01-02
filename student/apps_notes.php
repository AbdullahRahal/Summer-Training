<?php
// Connection to the database
include("db_connect.php"); 

// Fetch student details from the session
$studentName = $_SESSION['student_name'];
$studentNumber = $_SESSION['student_number'];

// Prepare SQL Query
$query = "SELECT app_body FROM app_notes WHERE std_name = ? AND std_num = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $studentName, $studentNumber); // 'ss' means two strings
$stmt->execute();
$result = $stmt->get_result();

// Check if there are results and display them
if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row['app_body'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No records found";
}
?>