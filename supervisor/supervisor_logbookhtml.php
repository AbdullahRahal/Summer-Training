<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    //Redirect to the login page if the user is not logged in
    header("Location: ../login.html");
    exit();
}

// Fetch admin information from the session
$csName = $_SESSION['cs_name'];
$csEmail = $_SESSION['username'];
$cscName = $_SESSION['cs_company_name'];
$csPhone = $_SESSION['cs_phone'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMU Internship</title>
    <link rel="stylesheet" href="nav-side.css" type="text/css">
    <link rel="stylesheet" href="supervisor_logbook.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                <h2 data-en="EMU Internship Supervisor" data-tr=" DAÜ Staj Gözetmeni">EMU Internship Supervisor</h2>
                </div>
            </div>
            <div class="top-bar-icon-container">
                <div class="user-info">
                    <a href="#" class="toggle-button"><i class="fas fa-user banner-icons"></i></a>
                    <div class="ddown-menu" id="menu-ddown" style="display: none;">
                    <h1  data-en="personal information" data-tr="Kişisel Bilgiler">personal information</h1>
                        <table>
                            <tr>
                                <th data-en="Name:" data-tr="Adı:">Name:</th>
                                <td><?php echo $csName; ?></td>
                            </tr>
                            <tr>
                                <th data-en="Phone Number:" data-tr="Telefon Numarası:">Phone Number:</th>
                                <td><?php echo $csPhone; ?></td>
                            </tr>
                            <tr>
                                <th data-en="Email:" data-tr="E-posta:">Email:</th>
                                <td><?php echo $csEmail; ?></td>
                            </tr>
                            <tr>
                                <th data-en="Company Name:" data-tr="Şirket Adı:">Company Name:</th>
                                <td><?php echo $cscName; ?></td>
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
                        <a href="supervisor_homehtml.php">Home</a>
                        <a href="supervisor_formhtml.php">Forms</a>
                        <a href="supervisor_logbookhtml.php">Logbook</a>
                        <a href="supervisor_contacthtml.php">Contact</a>
                    </div>
            </div>
        </nav>
    </header>
    <div class="aside-container">
        <aside>
            <div class="side-div">
            <a href="supervisor_homehtml.php" class="side-element"><i class="fas fa-home list-icon"></i>Home</a>
            <a href="supervisor_formhtml.php" class="side-element"><i class="fas fa-file-alt list-icon"></i>Form</a>
            <a href="supervisor_logbookhtml.php" class="side-element"><i class="fas fa-book list-icon"></i>Logbook</a>
            <a href="supervisor_contacthtml.php" class="side-element"><i class="fas fa-envelope list-icon"></i>Contact</a>
            </div>
            </aside>
            <main class="main-sec">
                <div class="container">
                <h1 data-en="Daily logbook" data-tr="Günlük Defter">Daily logbook</h1>
                <button class="evaluate" onclick="evaluateStudent()" style="display: block;" data-en="Evaluate" data-tr="Değerlendir">Evaluate</button>
            </div>
                <form action="">
                    <div class="table-container">
                        
                        <table>
                            <thead>
                                <tr>
                                <th data-en="Day" data-tr="Gün">Day</th>
                                <th data-en="Date" data-tr="Tarih">Date</th>
                                <th data-en="Department" data-tr="Bölüm">Department</th>
                                <th data-en="Description" data-tr="Açıklama">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include("logbooksgen.php");
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <form action="process_evaluation.php" method="post" id="evaluationForm"  class="evaluation-form"  style="display: none;">
                <h1 data-en="Evaluation Form" data-tr="Değerlendirme Formu">Evaluation Form</h1>
                        <table>
                          <tr>
                          <th data-en="Evaluation Criteria" data-tr="Değerlendirme Kriterleri">Evaluation Criteria</th>
                          <th data-en="Poor" data-tr="Zayıf">Poor</th>
                          <th data-en="Fair" data-tr="Orta">Fair</th>
                          <th data-en="Good" data-tr="İyi">Good</th>
                        <th data-en="Excellent" data-tr="Mükemmel">Excellent</th>       
                          </tr>
                          <tr>
                            <td data-en="Interest" data-tr="İlgi">Interest</td>
                            <td><input type="radio" name="interest" id="interest-poor" value="poor" required></td>
                            <td><input type="radio" name="interest" id="interest-fair" value="fair" required></td>
                            <td><input type="radio" name="interest" id="interest-good" value="good" required></td>
                            <td><input type="radio" name="interest" id="interest-excellent" value="excellent" required></td>
                          </tr>
                          <tr>
                            <td data-en="Attendance" data-tr="Katılım">Attendance</td>
                            <td><input type="radio" name="attendance" id="attendance-poor" value="poor" required></td>
                            <td><input type="radio" name="attendance" id="attendance-fair" value="fair" required></td>
                            <td><input type="radio" name="attendance" id="attendance-good" value="good" required></td>
                            <td><input type="radio" name="attendance" id="attendance-excellent" value="excellent" required></td>
                          </tr>
                          <tr>
                            <td data-en="Technical Knowledge and Ability" data-tr="Teknik Bilgi ve Yetenek">Technical Knowledge and Ability</td>
                            <td><input type="radio" name="Technical" id="Technical-poor" value="poor" required></td>
                            <td><input type="radio" name="Technical" id="Technical-fair" value="fair" required></td>
                            <td><input type="radio" name="Technical" id="Technical-good" value="good" required></td>
                            <td><input type="radio" name="Technical" id="Technical-excellent" value="excellent" required></td>
                          </tr>
                          <tr>
                            <td data-en="General Behavior" data-tr="Genel Davranış">General Behavior</td>
                            <td><input type="radio" name="generalbehavior" id="generalbehavior-poor" value="poor" required></td>
                            <td><input type="radio" name="generalbehavior" id="generalbehavior-fair" value="fair" required></td>
                            <td><input type="radio" name="generalbehavior" id="generalbehavior-good" value="good" required></td>
                            <td><input type="radio" name="generalbehavior" id="generalbehavior-excellent" value="excellent" required></td>
                          </tr>
                          <tr>
                            <td data-en="Overall Evaluation Result" data-tr="Genel Değerlendirme Sonucu">Overall Evaluation Result</td>
                            <td><input type="radio" name="overall" id="overall-poor" value="poor" required></td>
                            <td><input type="radio" name="overall" id="overall-fair" value="fair" required></td>
                            <td><input type="radio" name="overall" id="overall-good" value="good" required></td>
                            <td><input type="radio" name="overall" id="overall-excellent" value="excellent" required></td>
                          </tr>
                        </table>
                        <br>
                        <textarea name="summary_of_work_done" id="summary_of_work_done" rows="9" cols="40" placeholder="Summary of the Work Done during Internship"></textarea>
                        <br>
                        <textarea name="comments" id="comments" rows="9" cols="40" placeholder="General comments"></textarea>
                  
                    
                    <button type="button" id="submitEvaluationBtn" name="submit_eva" data-en="Submit Evaluation" data-tr="Değerlendirmeyi Gönder">Submit Evaluation</button>
                    <button type="button" name="cancel_eva" onclick="cancelEvaluation()" data-en="Close" data-tr="Kapat">Close</button>
                </form>
            </main>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get references to the menubar button and the dropdown menu
            const menubarButton = document.getElementById("menubar-button");
            const dropdownMenu = document.querySelector(".dropdown-menu");

            // Add a click event listener to the menubar button
            menubarButton.addEventListener("click", function () {
                // Toggle the visibility of the dropdown menu
                if (dropdownMenu.style.display === "block") {
                    dropdownMenu.style.display = "none";
                } else {
                    dropdownMenu.style.display = "block";
                }
            });
        });
        
        // for user info 
        document.querySelector(".toggle-button").addEventListener("click", function (event) {
            event.stopPropagation(); // Prevent the click event from bubbling up
                const dropdownMenu = document.getElementById("menu-ddown");
                dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", function (event) {
                const dropdownMenu = document.getElementById("menu-ddown");

                if (event.target !== document.querySelector(".toggle-button")) {
                    dropdownMenu.style.display = "none";
                }
            });
            function handleFileSelect(boxId) {
            var fileListInput = document.getElementById("file-input-" + boxId);
            var fileList = fileListInput.files;
            var fileListContainer = document.getElementById(boxId + "-files");
            var droppedContent = document.getElementById("dropped-content");

            while (fileListContainer.firstChild) {
                fileListContainer.removeChild(fileListContainer.firstChild);
            }

            if (fileList.length > 0) {
                droppedContent.style.display = "block";
                for (var i = 0; i < fileList.length; i++) {
                    var listItem = document.createElement("li");
                    listItem.textContent = fileList[i].name;
                    fileListContainer.appendChild(listItem);
                }
            }
        }


        function evaluateStudent() {
            const logbookForm = document.querySelector('.table-container');
            const evaluationForm = document.getElementById('evaluationForm');
            const evaluateButton = document.querySelector('.evaluate');

            // Get the current row count
            const rowCount = <?php echo $dayCount - 1; ?>;

            // Get the "Day" cell value for the last row
            const dayCell = document.getElementById('dayCell_' + rowCount);

            // Parse the "Day" value as an integer
            const dayValue = parseInt(dayCell.innerText);

            // Check if the "Day" value is at least 20
            if (dayValue >= 20) {
                // Hide logbook form
                logbookForm.style.display = 'none';

                // Show evaluation form
                evaluationForm.style.display = 'block';

                // Hide the "Evaluate" button
                evaluateButton.style.display = 'none';
            } else {
                // Display an error message or take some other action
                alert("You can't evaluate until the student finishes at least 20 days.");
            }
        }


        function cancelEvaluation() {
            const logbookForm = document.querySelector('.table-container');
            const evaluationForm = document.getElementById('evaluationForm');
            const evaluateButton = document.querySelector('.evaluate');

            // Hide evaluation form
            evaluationForm.style.display = 'none';

            // Show logbook form
            logbookForm.style.display = 'block';

            // Show the "Evaluate" button
            evaluateButton.style.display = 'block';
        }
        document.addEventListener("DOMContentLoaded", function() {
        var submitBtn = document.getElementById("submitEvaluationBtn");

        submitBtn.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default form submission

                // Collect form data
                var formData = new FormData(document.getElementById("evaluationForm"));

                // AJAX request
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "process_evaluation.php", true);

                // Set up a function to handle the response
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Success - Display or process the response
                        alert(xhr.responseText);
                    } else {
                        // Error - Handle the error
                        alert(xhr.statusText);
                    }
                };

                // Send the request with the form data
                xhr.send(formData);
            });
        });

    
    </script>
</body>
</html>