<?php
// Include database connection file
include_once 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $stdName = mysqli_real_escape_string($conn, $_POST['stdFname']);
    $stdNum = mysqli_real_escape_string($conn, $_POST['stdNo']);
    $stdPhone = mysqli_real_escape_string($conn, $_POST['stdPhone']);
    $stdEmail = mysqli_real_escape_string($conn, $_POST['stdEmail']);
    $stdAddress = mysqli_real_escape_string($conn, $_POST['stdPostalAddress']);
    $cName = mysqli_real_escape_string($conn, $_POST['cName']);
    $cPhone = mysqli_real_escape_string($conn, $_POST['comPhone']);
    $cEmail = mysqli_real_escape_string($conn, $_POST['comEmail']);
    $cFax = mysqli_real_escape_string($conn, $_POST['comFax']);
    $cField = mysqli_real_escape_string($conn, $_POST['workingField']);
    $cWebsite = mysqli_real_escape_string($conn, $_POST['comURL']);
    $cCountry = mysqli_real_escape_string($conn, $_POST['country']);
    $cDuration = mysqli_real_escape_string($conn, $_POST['duration']);
    $cWtbd = mysqli_real_escape_string($conn, $_POST['comWorkDes']);
    $cAddress = mysqli_real_escape_string($conn, $_POST['comPostalAddress']);
    $csFname = mysqli_real_escape_string($conn, $_POST['supFname']);
    $csLname = mysqli_real_escape_string($conn, $_POST['supLname']);
    $csEmail = mysqli_real_escape_string($conn, $_POST['supEmail']);
    $csPosition = mysqli_real_escape_string($conn, $_POST['supPosition']);

    $stdPhoto = '';
    if (isset($_FILES['stdPhoto']) && $_FILES['stdPhoto']['error'] == 0) {
        $allowed = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $filename = $_FILES['stdPhoto']['name'];
        $filetype = $_FILES['stdPhoto']['type'];
        $filesize = $_FILES['stdPhoto']['size'];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        $message = '';

        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            if (file_exists("upload/" . $filename)) {
                $message = urlencode($filename . " already exists.");
            } else {
                if (move_uploaded_file($_FILES['stdPhoto']['tmp_name'], "upload/" . $filename)) {
                    $message = urlencode("Your Form was uploaded successfully.");
                    $stdPhoto = "upload/" . $filename;
                } else {
                    $message = urlencode("Error: There was a problem uploading your file. Please try again.");
                }
            }
        } else {
            $message = urlencode("Error: Invalid file type.");
        }
        
        if ($_FILES['stdPhoto']['error']) {
            $message = urlencode("Error: " . $_FILES['stdPhoto']['error']);
        }

    // SQL query to insert data into the stdform table
    $sql = "INSERT INTO stdform (stdf_stdname, stdf_stdnum, stdf_stdphone, stdf_stdemail, stdf_stdaddress, stdf_stdphoto, stdf_cname, stdf_cphone, stdf_cemail, stdf_cfax, stdf_cfield, stdf_cwebsite, stdf_ccountry, stdf_cduration, stdf_cwtbd, stdf_caddress, stdf_csfname, stdf_cslname, stdf_csemail, stdf_csposition) VALUES ('$stdName', '$stdNum', '$stdPhone', '$stdEmail', '$stdAddress', '$stdPhoto', '$cName', '$cPhone', '$cEmail', '$cFax', '$cField', '$cWebsite', '$cCountry', '$cDuration', '$cWtbd', '$cAddress', '$csFname', '$csLname', '$csEmail', '$csPosition')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    // Redirect to applicationFormhtml.php with the message
    header('Location: applicationFormhtml.php?message=' . $message);
    exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
