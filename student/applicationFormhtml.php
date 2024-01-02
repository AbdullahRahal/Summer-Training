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
<?php
if (isset($_GET['message'])) {
    $alertMessage = htmlspecialchars($_GET['message']);
    echo "<script type='text/javascript'>alert('$alertMessage');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title>
    <link rel="stylesheet" href="pagesStyle.css" type="text/css">
    <link rel="stylesheet" href="applicationStyle.css" type="text/css">
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
                        <a href="#">Programs</a>
                        <a href="#">Forms</a>
                        <a href="#">Logbook</a>
                        <a href="#">Contact</a>
                    </div>
            </div>
        </nav>
    </header>
    <div class="container">
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
            <h1 style="border-bottom:2px solid #133e70;padding-bottom:5px;">application form</h1>
            <div class="form-container">
                <form action="upload_form.php" method="post" enctype="multipart/form-data">
                    <section>
                        <h2>student information</h2>
                        <div class="flex-div">
                            <div>
                                <label for="stdFname">Student name</label>
                                <input type="text" name="stdFname" id="stdFname" class="input-sec" value="<?php echo $studentName; ?>" required >
                                
                                <label for="stdNo">student no</label>
                                <input type="number" name="stdNo" id="stdNo" class="input-sec" value="<?php echo $studentNumber; ?>" required>
                                
                                <label for="stdPhone">phone no</label>
                                <input type="number" name="stdPhone" id="stdPhone" class="input-sec" required>
    
                                <label for="stdEmail">e-mail</label>
                                <input type="email" name="stdEmail" id="stdEmail" class="input-sec" value="<?php echo $studentEmail; ?>" required>
                            </div>
                            
                            <div>
                                <label for="stdPostalAddress">postal address</label>
                                <textarea name="stdPostalAddress" class="PostalAddress" cols="30" rows="10" required></textarea>
                                
                                <label for="upload-container">photo uploading</label>
                                <div class="upload-container">
                                    <label for="file-upload" class="upload-label">
                                        <input type="file" name="stdPhoto" id="file-upload" class="file-upload" onchange="displayFileName(this)">
                                    </label>

                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2>company information</h2>
                        <div class="flex-div">
                            <div>
                                <label for="cName">company name</label>
                                <input type="text" name="cName" id="cName" class="input-sec" required>

                                <label for="workingField">working field(s)</label>
                                <input type="text" name="workingField" id="workingField" class="input-sec" required>
                                
                                <label for="comURL">website</label>
                                <input type="url" name="comURL" id="comURL" class="input-sec" required>
                                
                                <label for="country">country</label>
                                <input type="text" name="country" id="country" class="input-sec">
                                
                                <label for="comWorkDes">work to be done</label>
                                <textarea name="comWorkDes" id="comWorkDes" class="PostalAddress" cols="30" rows="10" required></textarea>
                            </div>
                            <div>
                                <label for="comPhone">phone</label>
                                <input type="number" name="comPhone" id="comPhone" class="input-sec" required>
                                
                                <label for="comEmail">e-mail</label>
                                <input type="email" name="comEmail" id="comEmail" class="input-sec" required>
                    
                                <label for="comFax">fax</label>
                                <input type="number" name="comFax" id="comFax" class="input-sec">

                                <label for="duration">duration</label>
                                <select name="duration" id="duration" class="input-sec sel">
                                    <option value="20">20 days</option>
                                    <option value="40" selected>40 days</option>
                                </select>

                                <label for="comPostalAddress">postal address</label>
                                <textarea name="comPostalAddress" id="comPostalAddress" class="PostalAddress" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2>company supervisor</h2>
                        <div class="flex-div">
                            <div>
                                <label for="supFname">first name</label>
                                <input type="text" name="supFname" id="supFname" class="input-sec" required>

                                <label for="supEmail">e-mail</label>
                                <input type="email" name="supEmail" id="supEmail" class="input-sec" required>
                            </div>
                            <div>
                                <label for="supLname">last name</label>
                                <input type="text" name="supLname" id="supLname" class="input-sec" required>

                                <label for="supPosition">his/her position</label>
                                <input type="text" name="supPosition" id="supPosition" class="input-sec" required>
                            </div>
                        </div>
                    </section>
                    <div id="div-btn">
                        <button type="submit" id="apply-btn">Apply</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>