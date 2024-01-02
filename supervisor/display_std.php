<?php   
// Include the database connection file
require_once 'db_connect.php';

// Assign session variables
$csName = $_SESSION['cs_name'];
$csEmail = $_SESSION['username'];

// Prepare the SQL query
$query = "SELECT std_name, std_num, std_email FROM students WHERE cs_name = ? AND cs_email = ?";

// Prepare and execute the statement
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("ss", $csName, $csEmail);
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($std_name, $std_num, $std_email);

    // Fetch values and display them in a table
    echo "<table class='internee-tables'>";
    echo "<thead>";
    echo "<tr><th>name</th><th>student no</th><th>e-mail</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($std_name) . "</td>";
        echo "<td>" . htmlspecialchars($std_num) . "</td>";
        echo "<td>" . htmlspecialchars($std_email) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    // Close statement
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

// Close database connection
$conn->close();
?>