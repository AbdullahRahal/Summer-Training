<?php
include 'db_connect.php'; // Include your database connection file

$query = "SELECT * FROM company"; // Query to fetch data from your 'company' table
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    // Display each company as a grid item
    echo "<div class='grid-item' onclick='showForm(\"company{$row['cid']}-form\")'>";
    echo "<h2>" . htmlspecialchars($row['cname']) . "</h2>";
    echo "<h4>" . htmlspecialchars($row['ccountry']) . "</h4>";
    echo "<p>" . htmlspecialchars($row['cfeild']) . "</p>";
    echo "</div>";

    // Hidden form for each company with more details
    echo "<div class='hidden-form' id='company{$row['cid']}-form' style='display:none;'>";
    echo "<h2>Company Details</h2>";
    echo "<div class='viewF'>";
    echo "<div class='sides'>";
    echo "<p>Company Name: " . htmlspecialchars($row['cname']) . "</p>";
    echo "<p>Country: " . htmlspecialchars($row['ccountry']) . "</p>";
    echo "<p>Phone Number: " . htmlspecialchars($row['cphone']) . "</p>";
    echo "<p>Working Field: " . htmlspecialchars($row['cfeild']) . "</p>";
    echo "<p>Work to be Done: " . htmlspecialchars($row['cwork_to_be_done']) . "</p>";
    echo "</div>";
    echo "<div class='sides'>";
    echo "<p>Website: " . htmlspecialchars($row['cwebsite']) . "</p>";
    echo "<p>Fax: " . htmlspecialchars($row['cfax']) . "</p>";
    echo "<p>Email: " . htmlspecialchars($row['cemail']) . "</p>";
    echo "<p>Duration: " . htmlspecialchars($row['cduration']) . " working days</p>";
    echo "<p>Address: " . htmlspecialchars($row['caddress']) . "</p>";
    echo "</div>";
    echo "</div>";
    echo "<h3>Company Supervisor</h3>";
    echo "<div class='viewF'>";
    echo "<div class='sides'>";
    echo "<p>First Name: " . htmlspecialchars($row['csfname']) . "</p>";
    echo "<p>Last Name: " . htmlspecialchars($row['cslname']) . "</p>";
    echo "</div>";
    echo "<div class='sides'>";
    echo "<p>Email: " . htmlspecialchars($row['csemail']) . "</p>";
    echo "<p>Position: " . htmlspecialchars($row['csposition']) . "</p>";
    echo "</div>";
    echo "</div>";
    echo "<button onclick='hideForm(\"company{$row['cid']}-form\")'>Close</button>";
    echo "</div>";
}
?>
