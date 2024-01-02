<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $std_name = $_POST['std_name'];
    $std_email = $_POST['std_email'];
    $std_num = $_POST['std_num'];
    $academic_semester = $_POST['academic_semester'];
    $std_department = $_POST['std_department'];
    $std_password = password_hash($_POST['std_password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO students (std_name, std_email, std_num, academic_semester, std_department, std_password)
    VALUES ('$std_name', '$std_email', '$std_num', '$academic_semester', '$std_department', '$std_password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: controlPanelhtml.php?registration=success");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

$conn->close();
?>
