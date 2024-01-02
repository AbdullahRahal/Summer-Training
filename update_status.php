<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = $_POST['id']; // Ensure this matches the AJAX POST request
    $status = $_POST['status'];

    // Start a transaction
    mysqli_begin_transaction($conn);

    // Prepare the SQL statement to update status
    $query = "UPDATE stdform SET stdf_fstates = ? WHERE stdf_stdnum = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $status, $studentId);
    $executed = mysqli_stmt_execute($stmt);
    if (!$executed) {
        mysqli_rollback($conn);
        die("Error in statement execution: " . mysqli_error($conn));
    }

    // Check if rows were affected
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Retrieve student's name and number for the app_notes table
        $query = "SELECT stdf_stdname, stdf_stdnum FROM stdform WHERE stdf_stdnum = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $studentId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $student = mysqli_fetch_assoc($result);

        // Prepare message for app_notes
        $date = date("Y-m-d");
        $appBody = ($status === 'approved') ? 
            "Your application has been approved at $date" : 
            "Your application has been rejected at $date";

        // Insert into app_notes
        $query = "INSERT INTO app_notes (std_name, std_num, app_body) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $student['stdf_stdname'], $student['stdf_stdnum'], $appBody);
        mysqli_stmt_execute($stmt);

        // If approved, update student table with supervisor details
        if ($status === 'approved') {
            // Retrieve supervisor details
            $query = "SELECT stdf_csfname, stdf_cslname, stdf_csemail FROM stdform WHERE stdf_stdnum = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $studentId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $supervisor = mysqli_fetch_assoc($result);

            // Combine supervisor first name and last name
            $csName = $supervisor['stdf_csfname'] . " " . $supervisor['stdf_cslname'];
            $csEmail = $supervisor['stdf_csemail'];

            // Update student table with supervisor name and email
            $query = "UPDATE students SET cs_name = ?, cs_email = ? WHERE std_num = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssi", $csName, $csEmail, $studentId);
            mysqli_stmt_execute($stmt);
        }

        // Commit the transaction
        mysqli_commit($conn);
        echo "Status updated successfully";
    } else {
        echo "No rows updated. Check if the ID is correct.";
    }

    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
