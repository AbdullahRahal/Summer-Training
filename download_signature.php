<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';

$id = $_GET['id'];

try {
    // Fetching the signature data and filename from the database
    $stmt = $pdo->prepare("SELECT e_signature FROM confirmations WHERE con_id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $filename = $row['e_signature'];
        $fileData = $row['e_signature'];

        // Check if the file exists in the specified path
        $filePath = 'supervisor/' . $filename;
        if (file_exists($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            readfile($filePath);
        } else {
            echo "File not found.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
