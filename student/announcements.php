<?php
// Include the database connection file
include("db_connect.php");

// Query to retrieve announcements from the database
$query = "SELECT nnouncement_body FROM announcement";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Database query failed.");
}
?>

<?php
// Loop through the announcements and display them
while ($row = mysqli_fetch_assoc($result)) {
    echo "<li class='Announcement-item'>" . $row['nnouncement_body'] . "</li>";
}
?>
