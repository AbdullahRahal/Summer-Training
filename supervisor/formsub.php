<?php
session_start();

// Include database connection
require_once 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract cs_name and cs_email from the session
    $csName = $_SESSION['cs_name'] ?? 'default_cs_name'; // Replace 'default_cs_name' with a sensible default or handle the absence of this session variable appropriately
    $csEmail = $_SESSION['username'] ?? 'default_cs_email'; // Replace 'default_cs_email' with a sensible default

    // Extract form data
    $ccName = $_POST['companyName'];
    $ccField = $_POST['workingFields'];
    $ccAddress = $_POST['postalAddress'];
    $ccCity = $_POST['city'];
    $ccCountry = $_POST['country'];
    $ccTele = $_POST['telephoneNumber'];
    $ccFax = $_POST['fax']; // Assuming you have a fax field in your form
    $ccEmail = $_POST['organizationalEmail'];
    $ccWebsite = $_POST['organizationalWebAddress'];
    $stdSDate = $_POST['trainingStartDate'];
    $stdEDate = $_POST['trainingEndDate'];
    $workToBeDone = isset($_POST['workOptions']) ? implode(', ', $_POST['workOptions']) : '';
    $traineeName = $_POST['traineeName'];
    

    // Fetch std_num from students table
    $stmt = $conn->prepare("SELECT std_num FROM students WHERE cs_name = ? AND cs_email = ?");
    $stmt->bind_param("ss", $csName, $csEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $stdNum = '';
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stdNum = $row['std_num'];
    } else {
        echo "No student record found.";
        exit();
    }

    // File upload handling for e-stamp and e-signature
    $uploadDir = 'uploads/';
    $eStampPath = handleFileUpload($_FILES['file1'], $uploadDir);
    $eSignaturePath = handleFileUpload($_FILES['file2'], $uploadDir);

    // Prepare SQL to insert data into confirmations table
    $sql = "INSERT INTO confirmations (cs_name, cs_email, std_num, cc_name, cc_field, cc_address, cc_city, cc_country, cc_tele, cc_fax, cc_email, cc_website, std_s_date, std_e_date, work_to_be_done, e_stamp, e_signature, std_name) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssss", $csName, $csEmail, $stdNum, $ccName, $ccField, $ccAddress, $ccCity, $ccCountry, $ccTele, $ccFax, $ccEmail, $ccWebsite, $stdSDate, $stdEDate, $workToBeDone, $eStampPath, $eSignaturePath, $traineeName);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: supervisor_formhtml.php?message=Confirmation+submitted+successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// Function to handle file uploads
function handleFileUpload($file, $uploadDir) {
    if (isset($file) && $file['error'] == 0) {
        $fileName = basename($file['name']);
        $filePath = $uploadDir . $fileName;
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return $filePath;
        } else {
            echo "Error uploading file: " . $fileName;
            return '';
        }
    }
    return '';
}
?>
