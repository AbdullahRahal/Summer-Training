<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';

if(isset($_POST['delete-form']) && isset($_POST['stdf_id'])) {
    $stdf_id = $_POST['stdf_id'];
    echo "Deleting record with ID: $stdf_id"; // Debugging line

    $query = "DELETE FROM stdform WHERE stdf_id = ?";
    if($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $stdf_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo " - Record deleted."; // Debugging line
    } else {
        echo " - Failed to prepare statement."; // Debugging line
    }
    header("Location: controlPanelhtml.phps"); // Replace with your actual page URL
} else {
    echo "Delete request not received."; // Debugging line
}

mysqli_close($conn);
?>
