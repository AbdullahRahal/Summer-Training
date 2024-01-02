<?php
// Include the database connection file
require_once 'db_connect.php';
function db_connect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "summer_training";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Assign session variables to local variables for readability
$studentName = $_SESSION['student_name'];
$studentNumber = $_SESSION['student_number'];

// Connect to the database
$conn = db_connect(); // Assuming db_connect() returns a PDO or MySQLi connection object

// Prepare the SQL query
$query = "SELECT * FROM stdform WHERE stdf_stdname = ? AND stdf_stdnum = ? AND stdf_fstates = 'approved'";

// Prepare and execute the statement
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("ss", $studentName, $studentNumber); // "ss" denotes two string parameters
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        // Generate the HTML content
        echo "<div class='com-side'>";
        echo "<p>Company Name: " . htmlspecialchars($row['stdf_cname']) . "</p>";
        echo "<p>Company Email: " . htmlspecialchars($row['stdf_cemail']) . "</p>";
        echo "<p>Phone Number: " . htmlspecialchars($row['stdf_cphone']) . "</p>";
        echo "</div>";
        echo "<div class='com-side'>";
        echo "<p>Supervisor Name: " . htmlspecialchars($row['stdf_csfname']) . " " . htmlspecialchars($row['stdf_cslname']) . "</p>";
        echo "<p>Supervisor Email: " . htmlspecialchars($row['stdf_csemail']) . "</p>";
        echo "<p>Internship Duration: " . htmlspecialchars($row['stdf_cduration']) . "</p>";
        echo "</div>";
    } else {
        echo "No approved record found for the specified student.";
    }

    $stmt->close();
} else {
    echo "Error preparing query.";
}

// Close the database connection
$conn->close();
?>
