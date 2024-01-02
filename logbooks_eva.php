<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection file
require_once 'db_connect.php';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=localhost;dbname=summer_training", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Updated SQL to join logbooks_eva and students tables and select required columns
    // Add a condition to check if eva_state is NULL
    $sql = "SELECT le.std_name, le.std_num, s.std_department, le.eva1, le.eva2
            FROM logbooks_eva le
            JOIN students s ON le.std_name = s.std_name AND le.std_num = s.std_num
            WHERE le.eva_state IS NULL";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Check if any rows are returned
    if ($stmt->rowCount() > 0) {
        // Fetch all the rows from the query result
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Generate the HTML table rows
        foreach ($rows as $row) {
            $stdNum = htmlspecialchars($row['std_num']);
            $stdName = htmlspecialchars($row['std_name']);
            echo "<tr>";
            echo "<td>$stdName</td>";
            echo "<td>$stdNum</td>";
            echo "<td>" . htmlspecialchars($row['std_department']) . "</td>";
            echo "<td><a href='javascript:void(0)' onclick='logbookfile(\"$stdNum\", \"$stdName\")'>LogBooks</a></td>";
            echo "<td><a href='javascript:void(0)' data-stdnum='$stdNum' onclick='fetchEvaluationData(event, \"$stdNum\", \"$stdName\")'>Evaluation</a></td>";
            echo "<td class='action-cell'>";
            echo "<button class='approve-button' onclick='updateEvaluationStatus(\"$stdNum\", \"$stdName\", \"Approved\")'>Approve</button>";
            echo "<button class='reject-button' onclick='updateEvaluationStatus(\"$stdNum\", \"$stdName\", \"Rejected\")'>Reject</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "No rows found";
    }

} catch (PDOException $e) {
    // Handle any errors
    die("Database error: " . $e->getMessage());
}
?>
