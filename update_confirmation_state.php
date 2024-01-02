<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['con_id']) && isset($_POST['new_state'])) {
    $conId = $_POST['con_id'];
    $newState = $_POST['new_state'];

    // Security measure: Only allow specific state values
    if (!in_array($newState, ['approved', 'rejected'])) {
        echo "Invalid state value";
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE confirmations SET con_state = ? WHERE con_id = ?");
        $stmt->execute([$newState, $conId]);

        echo "State updated to " . $newState;
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request";
}
?>
