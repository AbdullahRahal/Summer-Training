<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection file
require_once 'db_connect.php';

// Check if student number and name are provided
if (isset($_GET['std_num']) && isset($_GET['std_name'])) {
    $std_num = $_GET['std_num'];
    $std_name = $_GET['std_name'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=summer_training", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM logbooks WHERE std_num = :std_num AND std_name = :std_name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['std_num' => $std_num, 'std_name' => $std_name]);

        if ($stmt->rowCount() > 0) {
            // Fetch all rows
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<table>";
            echo "<tr><th>Day</th><th>Date</th><th>Department</th><th>Description</th></tr>";
            
            $counter = 1; // Initialize counter
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>" . $counter++ . "</td>"; // Increment counter for each row
                echo "<td>" . htmlspecialchars($row['book_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['book_department']) . "</td>";
                echo "<td>" . htmlspecialchars($row['book_Description']) . "</td>";
                echo "</tr>";
            }
        
            echo "</table>";
        } else {
            echo "No logbook entries found for this student.";
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    echo "Student number and name are required.";
}
?>
