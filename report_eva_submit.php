<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    include 'db_connect.php'; // Include your DB connection script

    // Fetch the form data and report ID
    $report_id = $_POST['report_id'];
    $quality = $_POST['quality'];
    $it_work = $_POST['it-work'];
    $knowledge = $_POST['knowledge'];
    $answering = $_POST['answering'];
    $overall = $_POST['overall'];
    $comments = $_POST['comments'];

    // Prepare an SQL statement to update the data
    $stmt = $conn->prepare("UPDATE reports SET report_e_1=?, report_e_2=?, report_e_3=?, report_e_4=?, report_e_5=?, report_e_comments=? WHERE report_id=?");
    $stmt->bind_param("ssssssi", $quality, $it_work, $knowledge, $answering, $overall, $comments, $report_id);

    // Execute the query
    $stmt->execute();

    // Close the statement and connection


    // Execute the query
    if ($stmt->execute()) {
        echo "Evaluation submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
