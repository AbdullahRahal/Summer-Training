<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connect.php';

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // CSRF check (recommended) goes here

    $stmt = $conn->prepare("DELETE FROM contact WHERE contact_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Redirect back to the contacts page after deletion
        header("Location: controlPanelhtml.php#section-3");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
