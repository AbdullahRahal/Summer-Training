<?php
// Include the database connection file
include 'db_connect.php';

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from the table
$sql = "SELECT * FROM confirmations WHERE con_state IS NOT NULL";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $e_stamp_path = "supervisor/" . $row['e_stamp'];
        $e_signature_path = "supervisor/" . $row['e_signature'];

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["std_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["cc_name"]) . "</td>";
        echo "<td><a href='javascript:void(0);' onclick='displayInfoCom(" . $row["con_id"] . ")'>confirmation</a></td>";

        // Detailed information structure
        echo "<div class='con-file-hidden' id='info-" . $row["con_id"] . "' style=''>";
        echo "<h2>Information about the Company and Trainee</h2>";
        echo "<div class='view-apply'>";
        echo "<div class='sides-apply'>";
        echo "<p>Company Name: " . htmlspecialchars($row["cc_name"]) . "</p>";
        echo "<p>Working field(s): " . htmlspecialchars($row["cc_field"]) . "</p>";
        echo "<p>Phone No: " . htmlspecialchars($row["cc_tele"]) . "</p>";
        echo "<p>Fax: " . htmlspecialchars($row["cc_fax"]) . "</p>";
        echo "<p>Company E-mail: " . htmlspecialchars($row["cc_email"]) . "</p>";
        echo "<p>City: " . htmlspecialchars($row["cc_city"]) . "</p>";
        echo "<p>Country: " . htmlspecialchars($row["cc_country"]) . "</p>";
        echo "</div>";
        echo "<div class='sides-apply'>";
        echo "<p>Company Website: " . htmlspecialchars($row["cc_website"]) . "</p>";
        echo "<p>Student name: " . htmlspecialchars($row["std_name"]) . "</p>";
        echo "<p>Start date(planned): " . htmlspecialchars($row["std_s_date"]) . "</p>";
        echo "<p>End date(planned): " . htmlspecialchars($row["std_e_date"]) . "</p>";
        echo "<p>Postal address: " . htmlspecialchars($row["cc_address"]) . "</p>";
        echo "</div>";
        echo "</div>";
        echo "<h2>The work to be done by the student</h2>";
        echo "<div class='view-apply'>";
        echo "<div class='sides-apply'>";
        echo "<ul>";
        echo "<li>" . htmlspecialchars($row["work_to_be_done"]) . "</li>";
        // Add more list items if needed
        echo "</ul>";
        echo "</div>";
        echo "<div class='sides-apply'>";
        echo "<h3>Official Signature and Stamp of the Company</h3>";
        echo "<p>E-stamp: <a href='" . htmlspecialchars($e_stamp_path) . "' download>Download</a></p>";
        echo "<p>E-signature: <a href='" . htmlspecialchars($e_signature_path) . "' download>Download</a></p>";
        echo "</div>";
        echo "</div>";
        echo "<button type='button' onclick='displayInfoCom()'>Close</button>";
        echo "</div>";

        echo "<td class='action-cell'>";
        echo "<button class='reject-button' name='delete-form'>Delete</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No results found</td></tr>";
}

// Close the connection
$conn->close();
?>
