<?php
// Include the database connection file
require_once 'db_connect.php';

// Fetch student information from the session
$studentNumber = $_SESSION['student_number'];
$studentName = $_SESSION['student_name'];

// Prepare the SQL query to select logbook entries for the current user
$query = "SELECT book_day, book_date, book_department, book_Description FROM logbooks 
          WHERE std_num = ? AND std_name = ? ORDER BY book_date ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $studentNumber, $studentName);
$stmt->execute();
$result = $stmt->get_result();

// HTML structure
echo '<div class="table-container">';
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>Day</th>';
echo '<th>Date</th>';
echo '<th>Department</th>';
echo '<th>Description</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Loop through the results and display each row
$dayCount = 1;
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $dayCount++ . '</td>';
    echo '<td>' . $row['book_date'] . '</td>';
    echo '<td>' . $row['book_department'] . '</td>';
    echo '<td>' . $row['book_Description'] . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Close the statement and connection
$stmt->close();
$conn->close();
?>
