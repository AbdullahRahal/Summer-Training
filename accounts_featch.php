<?php
// Include the database connection file
include 'db_connect.php';

// Create a query to fetch student data
$query = "SELECT std_name, std_num, std_email, academic_semester, std_department FROM students";

// Execute the query
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["std_name"] . "</td>";
        echo "<td>" . $row["std_num"] . "</td>";
        echo "<td>" . $row["std_email"] . "</td>";
        echo "<td>" . $row["academic_semester"] . "</td>";
        echo "<td>" . $row["std_department"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
