<?php
// Include the database connection file
include 'db_connect.php';

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to fetch the required data
$sql = "SELECT * FROM reports WHERE report_e_1 IS NULL AND report_e_2 IS NULL AND report_e_3 IS NULL AND report_e_4 IS NULL AND report_e_5 IS NULL AND report_e_comments IS NULL";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["std_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["std_num"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["std_department"]) . "</td>";
    
        // Prepend the 'student/' directory to the file name
        $filePath = "student/" . htmlspecialchars($row["report_file"]);
        echo "<td><a href='" . $filePath . "'>" . htmlspecialchars($row["std_name"]) . ".pdf</a></td>";
    
        // Add the evaluate button
        echo "<td><button type='button' onclick='show_eva(" . $row["report_id"] . ")'>evaluate</button></td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

// Close the database connection
mysqli_close($conn);
?>
