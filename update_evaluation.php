<?php
require_once 'db_connect.php';

if(isset($_POST['std_num']) && isset($_POST['std_name']) && isset($_POST['eva_state'])) {
    $stdNum = $_POST['std_num'];
    $stdName = $_POST['std_name'];
    $evaState = $_POST['eva_state'];

    // Prepare and execute the SQL statement
    $sql = "UPDATE logbooks_eva SET eva_state = ? WHERE std_num = ? AND std_name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$evaState, $stdNum, $stdName]);

    echo "Update successful";
} else {
    echo "Invalid request";
}
?>
