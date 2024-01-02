<?php
// Include the database connection file
require 'db_connect.php';

// Create a query to fetch rows where stdf_fstates is not null
$query = "SELECT * FROM stdform WHERE stdf_fstates IS NOT NULL";

// Execute the query
$result = mysqli_query($conn, $query);

if(!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Start the tbody tag
echo "<tbody>";

// Fetch and display the rows
while($row = mysqli_fetch_assoc($result)) {
    $uniqueId = "details_" . $row['stdf_id']; // Create a unique ID using stdf_id

    // Start the table row
    echo "<tr>";

    // Display student name and number
    echo "<td>" . htmlspecialchars($row['stdf_stdname']) . "</td>";
    echo "<td>" . htmlspecialchars($row['stdf_stdnum']) . "</td>";

    // Application link and hidden details
    echo "<td><a href=\"javascript:void(0);\" onclick=\"displayInfoApply('$uniqueId')\">application</a>";
    echo "<div class=\"apply-file-hidden\" id=\"$uniqueId\" style=\"display:none;\">";

    // Student Information
    echo '<h2>Student Information</h2>';
    echo '<div class="view-apply">';
    echo '<div class="sides-apply">';
    echo '<p>Status: ' . htmlspecialchars($row['stdf_fstates']) . '</p>';
    echo '<p>Student Name: ' . htmlspecialchars($row['stdf_stdname']) . '</p>';
    echo '<p>Student No: ' . htmlspecialchars($row['stdf_stdnum']) . '</p>';
    echo '<p>Phone No: ' . htmlspecialchars($row['stdf_stdphone']) . '</p>';
    echo '<p>E-Mail: ' . htmlspecialchars($row['stdf_stdemail']) . '</p>';
    echo '<p>Address: ' . htmlspecialchars($row['stdf_stdaddress']) . '</p>';
    echo '</div>';
    echo '<div class="sides-apply">';
    echo '<div class="photo-div">';
    echo '<img src="student/' . htmlspecialchars($row['stdf_stdphoto']) . '" alt="">'; // Assuming stdf_stdphoto contains the filename
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Company Details
    echo '<h2>Company Details</h2>';
    echo '<div class="view-apply">';
    echo '<div class="sides-apply">';
    echo '<p>Company Name: ' . htmlspecialchars($row['stdf_cname']) . '</p>';
    echo '<p>Country: ' . htmlspecialchars($row['stdf_ccountry']) . '</p>';
    echo '<p>Phone Number: ' . htmlspecialchars($row['stdf_cphone']) . '</p>';
    echo '<p>Working Field: ' . htmlspecialchars($row['stdf_cfield']) . '</p>';
    echo '<p>Work to be Done: ' . htmlspecialchars($row['stdf_cwtbd']) . '</p>';
    echo '</div>';
    echo '<div class="sides-apply">';
    echo '<p>Website: ' . htmlspecialchars($row['stdf_cwebsite']) . '</p>';
    echo '<p>Fax: ' . htmlspecialchars($row['stdf_cfax']) . '</p>';
    echo '<p>Email: ' . htmlspecialchars($row['stdf_cemail']) . '</p>';
    echo '<p>Duration: ' . htmlspecialchars($row['stdf_cduration']) . '</p>';
    echo '<p>Address: ' . htmlspecialchars($row['stdf_caddress']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Company Supervisor
    echo '<h2>Company Supervisor</h2>';
    echo '<div class="view-apply">';
    echo '<div class="sides-apply">';
    echo '<p>First Name: ' . htmlspecialchars($row['stdf_csfname']) . '</p>';
    echo '<p>Last Name: ' . htmlspecialchars($row['stdf_cslname']) . '</p>';
    echo '</div>';
    echo '<div class="sides-apply">';
    echo '<p>E-Mail: ' . htmlspecialchars($row['stdf_csemail']) . '</p>';
    echo '<p>Position: ' . htmlspecialchars($row['stdf_csposition']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Close button
    echo "<button type=\"button\" onclick=\"displayInfoApply('$uniqueId')\">close</button>";

    // End the hidden details div
    echo "</div></td>";

    // Action cell
    echo "<td class=\"action-cell\">";
    echo "<form method='post' action='delete_record.php'>";
    echo "<input type='hidden' name='stdf_id' value='" . $row['stdf_id'] . "'>";
    echo "<button type='submit' class='reject-button' name='delete-form'>Delete</button>";
    echo "</form>";
    echo "</td>";

    // End the table row
    echo "</tr>";
}

// End the tbody tag
echo "</tbody>";

// Close the database connection
mysqli_close($conn);
?>
