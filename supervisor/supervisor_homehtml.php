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
    <link rel="stylesheet" href="supervisor_home.css" type="text/css">
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
            <h1 style="border-bottom:2px solid #133e70;padding-bottom:5px;" data-en="Home" data-tr="Ana Sayfa">
                Home
            </h1>
            <div id="cards-container">
                <div class="cards">
                    <h1  data-en="Announcement" data-tr="Duyuru">Announcement</h1>
                    
                    <div class="detail-container">
                        <ul class="Announcement-list">
                            <?php
                            include("announcements.php"); // Include the announcements file
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="cards">
                    <h1 data-en="Internees" data-tr="Bildirimler">Internees</h1>
                    <div class="detail-container-side">
                        <?php include 'display_std.php'; ?>
                    </div>
                </div>
            </div>
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
            event.preventDefault(); // Prevent the default behavior of the anchor tag
            event.stopPropagation(); // Prevent the click event from bubbling up
            const dropdownMenu = document.getElementById("menu-ddown");
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });
        document.addEventListener("click", function(event) {
            const dropdownMenu = document.getElementById("menu-ddown");
            if (event.target !== document.querySelector(".toggle-button")) {
                dropdownMenu.style.display = "none";
            }
        });
    </script>
</body>
</html>