<?php
include 'db_connect.php'; // Include your database connection file

// Fetch user information from session
$csName = $_SESSION['cs_name'];
$csEmail = $_SESSION['username'];
$cscName = $_SESSION['cs_company_name'];
$csPhone = $_SESSION['cs_phone'];

// Query to find the student's std_num and std_name
$studentQuery = "SELECT std_num, std_name FROM students WHERE cs_name = ? AND cs_email = ?";
$stmt = $conn->prepare($studentQuery);
$stmt->bind_param("ss", $csName, $csEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    $std_num = $student['std_num'];
    $std_name = $student['std_name'];

    // Query to get logbook entries
    $logbookQuery = "SELECT book_date, book_department, book_Description FROM logbooks WHERE std_num = ? AND std_name = ?";
    $stmt = $conn->prepare($logbookQuery);
    $stmt->bind_param("ss", $std_num, $std_name);
    $stmt->execute();
    $logbookResult = $stmt->get_result();
    
    // Dynamically generate table rows
    $dayCount = 1;
    while ($row = $logbookResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td id='dayCell_" . $dayCount . "'>" . $dayCount++ . "</td>";
        echo "<td>" . $row['book_date'] . "</td>";
        echo "<td>" . $row['book_department'] . "</td>";
        echo "<td>" . $row['book_Description'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "Student not found.";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
