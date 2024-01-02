<?php
// Database connection information
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'summer_training';

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}

// Fetch admin information from the session
$adminName = $_SESSION['admin_name'];
$adminEmail = $_SESSION['username'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addAnnouncementButton'])) {
        // Get the announcement content from the form
        $announcementBody = $_POST['add-ann-area'];

        // Insert the announcement into the database
        $sql = "INSERT INTO announcement (nnouncement_body) VALUES ('$announcementBody')";

        if ($conn->query($sql) === TRUE) {
            // Announcement added successfully
            $redirectUrl = "controlPanelhtml.php#section-1";
            header("Location: $redirectUrl");
            exit();
        } else {
            // Error adding announcement
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
?>