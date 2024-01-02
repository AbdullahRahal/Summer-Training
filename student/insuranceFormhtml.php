<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    //Redirect to the login page if the user is not logged in
    header("Location: ../login.html");
    exit();
}

// Fetch admin information from the session
$studentName = $_SESSION['student_name'];
$studentEmail = $_SESSION['username'];
$studentNumber = $_SESSION['student_number'];
$studentSemester = $_SESSION['student_semester'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMU Internship</title>
    <link rel="stylesheet" href="nav-side.css" type="text/css">
    <link rel="stylesheet" href="pagesStyle.css" type="text/css">
    <link rel="stylesheet" href="insuranceForm.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="studentScript.js" defer></script>
    <script src="translate.js" defer></script>
</head>
<body>
    <header>
        <nav>
            <div id="logodiv">
                <div class="logo" class="headerdivs" id="logocss">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/b/b8/EMU_Cyprus.svg/300px-EMU_Cyprus.svg.png" alt="EMU Logo">
                </div>
                <div class="headerdivs">
                    <h2>EMU Internship</h2>
                </div>
            </div>
            <div class="top-bar-icon-container">
                <div class="user-info">
                    <a href="#" class="toggle-button"><i class="fas fa-user banner-icons"></i></a>
                    <div class="ddown-menu" id="menu-ddown" style="display: none;">
                        <h1>personal information</h1>
                        <table>
                            <tr>
                                <th>Name:</th>
                                <td><?php echo $studentName; ?></td>
                            </tr>
                            <tr>
                                <th>Student Number:</th>
                                <td><?php echo $studentNumber; ?></td>
                            </tr>
                            <tr>
                                <th>Acadimec Semester:</th>
                                <td><?php echo $studentSemester; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $studentEmail; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="menudiv">
                <div class="language-select">
                        <select id="language-select">
                            <option value="en">English</option>
                            <option value="tr">Turkish</option>
                        </select>
                    </div>
                    <a href="../logout.php"><i class="fas fa-sign-out-alt banner-icons"></i></a>
                </div>
                    <div id="menubar-button"><a href="#" class="menubar"><i class="fas fa-bars" id="menu-icon"></i></a></div>
                    <div class="dropdown-menu" id="menu-dropdown">
                        <a href="#">Home</a>
                        <a href="#">Forms</a>
                        <a href="#">Logbook</a>
                        <a href="#">Contact</a>
                    </div>
            </div>
        </nav>
    </header>
    <div class="aside-container">
        <aside>
            <div class="side-div">
                <a href="homehtml.php" class="side-element"><i class="fas fa-home list-icon"></i>Home</a>
                <a href="programhtml.php" class="side-element"><i class="fas fa-graduation-cap list-icon"></i>Programs</a>
                <a href="applicationFormhtml.php" class="side-element"><i class="fas fa-file-alt list-icon"></i>Apply</a>
                <a href="insuranceFormhtml.php" class="side-element"><i class="fas fa-file-alt list-icon"></i>Insurance</a>
                <a href="logbookhtml.php" class="side-element"><i class="fas fa-book list-icon"></i>Logbook</a>
                <a href="Reporthtml.php" class="side-element"><i class="fas fa-book list-icon"></i>Report</a>
                <a href="contacthtml.php" class="side-element"><i class="fas fa-envelope list-icon"></i>Contact</a>
            </div>
        </aside>

        <main class="main-sec">
            <h1 style="border-bottom:2px solid #133e70;padding-bottom:5px;">Insurance</h1>
            <div class="main-container">
                <div class="container">
                    <h2>Insurance form</h2>
                    <p>If you will do your internship in <b>Turkey</b> or <b>TRNC</b>, you should submit insurance form (according to the regulations of these countries).</p>
                    <p>You can download the file and fill it, before that you must follow the <b>instructions</b></p>
                    <a href="3-ITEC400InsuranceForm.docx" class="download-button">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
    
                <div class="container">
                    <h2>Instructions</h2>
                    <ol class="Instructions">
                        <li>Download the file then fill and prints 3 copies.</li>
                        <li>You & company supervisor must signed the <b>3 copies.</b></li>
                        <li>Pay the insurance fee at the bank and take a receipt.</li>
                        <li>Print 3 copies of your identity card/passport.</li>
                        <li>
                            What you must submit to the departmental internship coordinator:
                            <ul>
                                <li>3 copies of the insurance form <b>signed.</b></li>
                                <li>3 copies of your identity card/passport.</li>
                                <li>The bank receipt.</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>
        </div>


        </main>
    </div>
</body>
</html>