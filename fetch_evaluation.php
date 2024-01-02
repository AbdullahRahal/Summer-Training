<?php
require_once 'db_connect.php';

header('Content-Type: application/json');

if(isset($_GET['std_num']) && isset($_GET['std_name'])) {
    $stdNum = $_GET['std_num'];
    $stdName = $_GET['std_name'];

    // Prepare and execute the SQL statement
    $sql = "SELECT * FROM logbooks_eva WHERE std_num = ? AND std_name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$stdNum, $stdName]);

    // Fetch the data
    $evaluation = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the data as JSON
    echo json_encode($evaluation);
} else {
    echo json_encode(['error' => 'Missing parameters']);
}
?>
