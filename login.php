<?php
session_start();

// Constants for login attempts and timeout
$maxLoginAttempts = 5;
$timeoutDuration = 60; // in seconds

// Replace the following placeholders with your actual MySQL credentials
$hostname = "localhost";
$username = "root";
$password = "";
$database = "summer_training";

// Establish a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is temporarily locked out
    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $maxLoginAttempts) {
        $timeElapsed = time() - $_SESSION['last_attempt_time'];

        if ($timeElapsed < $timeoutDuration) {
            $remainingTime = $timeoutDuration - $timeElapsed;

            // Capture the message
            $errorMessage = "Too many login attempts. Please try again in $remainingTime seconds.";

            // Debugging statement
            var_dump($_SESSION);

            // Display an alert with the captured message
            echo "<script>alert('$errorMessage'); window.location.href='login.html';</script>";
            exit();
        } else {
            // Reset the login attempts if the timeout has passed
            unset($_SESSION['login_attempts']);
            unset($_SESSION['last_attempt_time']);
        }
    }

    $email = $_POST["username"];
    $password = $_POST["password"];

    // Check in admin table
    $queryAdmin = "SELECT admin_id, admin_name, admin_password FROM admin WHERE admin_email = ?";
    $stmtAdmin = $conn->prepare($queryAdmin);
    $stmtAdmin->bind_param("s", $email);
    $stmtAdmin->execute();
    $stmtAdmin->bind_result($adminId, $adminName, $hashedAdminPassword);

    if ($stmtAdmin->fetch() && password_verify($password, $hashedAdminPassword)) {
        // Admin login successful, reset login attempts
        unset($_SESSION['login_attempts']);
        unset($_SESSION['last_attempt_time']);

        // Set session variables
        $_SESSION["user_id"] = $adminId;
        $_SESSION["username"] = $email;
        $_SESSION["User_type"] = "Admin";
        $_SESSION["admin_name"] = $adminName;
        $stmtAdmin->close();
        redirectToControlPanel();
    } else {
        $stmtAdmin->close();  // Close the statement if the login attempt fails
    }

    // Check in students table
    $queryStudents = "SELECT std_id, std_name, std_password, std_num, academic_semester FROM students WHERE std_email = ?";
    $stmtStudents = $conn->prepare($queryStudents);
    $stmtStudents->bind_param("s", $email);
    $stmtStudents->execute();
    $stmtStudents->bind_result($studentId, $studentName, $hashedStudentPassword, $studentNumber, $studentSemester);

    if ($stmtStudents->fetch() && password_verify($password, $hashedStudentPassword)) {
        // Student login successful, reset login attempts
        unset($_SESSION['login_attempts']);
        unset($_SESSION['last_attempt_time']);

        // Set session variables
        $_SESSION["user_id"] = $studentId;
        $_SESSION["username"] = $email;
        $_SESSION["User_type"] = "Student";
        $_SESSION["student_name"] = $studentName;
        $_SESSION["student_number"] = $studentNumber;
        $_SESSION["student_semester"] = $studentSemester;
        $stmtStudents->close();
        redirectToStudentPage();
    } else {
        $stmtStudents->close();  // Close the statement if the login attempt fails
    }

    // Check in company_cs table
    $queryCompanyCS = "SELECT cs_id, cs_name, cs_password, cs_company_name, cs_phone FROM company_cs WHERE cs_email = ?";
    $stmtCompanyCS = $conn->prepare($queryCompanyCS);
    $stmtCompanyCS->bind_param("s", $email);
    $stmtCompanyCS->execute();
    $stmtCompanyCS->bind_result($csId, $csName, $hashedCSPassword, $cscName, $csphone);

    if ($stmtCompanyCS->fetch() && password_verify($password, $hashedCSPassword)) {
        // Company CS login successful, reset login attempts
        unset($_SESSION['login_attempts']);
        unset($_SESSION['last_attempt_time']);

        // Set session variables
        $_SESSION["user_id"] = $csId;
        $_SESSION["username"] = $email;
        $_SESSION["User_type"] = "CompanyCS";
        $_SESSION["cs_name"] = $csName;
        $_SESSION["cs_company_name"] = $cscName;
        $_SESSION["cs_phone"] = $csphone;
        $stmtCompanyCS->close();
        redirectToCSPage();
    } else {
        $stmtCompanyCS->close();  // Close the statement if the login attempt fails
    }

    // Increment login attempts and set the last attempt time
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 1;
    } else {
        $_SESSION['login_attempts']++;
    }

    $_SESSION['last_attempt_time'] = time();

    // Debugging statement
    var_dump($_SESSION);

    // Display an alert on unsuccessful login
    echo "<script>alert('Invalid email or password'); window.location.href='login.html';</script>";
    exit();
}

$conn->close();

// Helper functions
function redirectToControlPanel() {
    header("Location: controlPanelhtml.php");
    exit();
}
function redirectToStudentPage() {
    header("Location: student\homehtml.php");
    exit();
}
function redirectToCSPage() {
    header("Location: supervisor\supervisor_homehtml.php");
    exit();
}
?>
