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
    <link rel="stylesheet" href="supervisor_form.css" type="text/css">
    <script src="supervisor_forms.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="translate.js" defer></script>

</head>
<body>
    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                alert(decodeURIComponent(message));
            }
        };
    </script>

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
            </div>

        <main class="main-sec">
            <h1 style="border-bottom:2px solid #133e70;padding-bottom:5px;" data-en="Confirmation form" data-tr="Onay Formu">Confirmation form</h1>
            
            <div class="main-container">
                <div class="container1">
                    <form action="formsub.php" method="post" enctype="multipart/form-data">
                            <h3 style="border-bottom:2px solid #133e70;padding-bottom:5px;" data-en="Information about the Company and Trainee" data-tr="Şirket ve Stajyer Hakkında Bilgiler">Information about the Company and Trainee</h3>
                            <!-- Company Information -->
                            <div class="form-group">
                                <label for="companyName" data-en="Name of the Company *" data-tr="Şirketin Adı *">Name of the Company *</label>
                                <input type="text" id="companyName" name="companyName" required>
                                <label for="workingFields" data-en="Working Field(s) *" data-tr="Çalışma Alanı(lar) *">Working Field(s) *</label>
                                <input type="text" id="workingFields" name="workingFields" required>
                            </div>
                
                            <label for="postalAddress" data-en="Postal Address *" data-tr="Posta Adresi *">Postal Address *</label>
                            <textarea id="postalAddress" name="postalAddress" rows="7" required></textarea>
                
                            <div class="form-group">
                                <label for="city" data-en="City *" data-tr="Şehir *">City *</label>
                                <input type="text" id="city" name="city" required>
                                
                                <label for="country" data-en="Country *" data-tr="Ülke *">Country *</label>
                                <input type="text" id="country" name="country" required>
                            </div>
                
                            <div class="form-group">
                                <label for="fax" data-en="Fax *" data-tr="Faks *">Fax</label>
                                <input type="text" id="fax" name="fax">                                
                                <label for="telephoneNumber" data-en="Telephone Number *" data-tr="Telefon Numarası *">Telephone Number *</label>
                                <input type="tel" id="telephoneNumber" name="telephoneNumber" required>
                            </div>
                            <div class="form-group">
                                <label for="organizationalEmail" data-en="Organizational E-mail *" data-tr="Kurumsal E-posta *">Organizational E-mail *</label>
                                <input type="email" id="organizationalEmail" name="organizationalEmail" required>
                                
                                <label for="organizationalWebAddress" data-en="Organizational Web Address *" data-tr="Kurumsal Web Adresi *">Organizational Web Address *</label>
                                <input type="url" id="organizationalWebAddress" name="organizationalWebAddress" required>
                            </div>
                
                            <!-- Trainee Information -->
                            <div class="form-group">
                                <label for="traineeName" data-en="Name and Surname of the Trainee *" data-tr="Stajyerin Adı ve Soyadı *">Name and Surname of the Trainee *</label>
                                <input type="text" id="traineeName" name="traineeName" required>
                                
                                <label for="trainingStartDate" data-en="Planned Training Start Date *" data-tr="Planlanan Eğitim Başlangıç Tarihi *">Planned Training Start Date *</label>
                                <input type="date" id="trainingStartDate" name="trainingStartDate" required>
                                
                                <label for="trainingEndDate" data-en="Planned Training End Date *" data-tr="Planlanan Eğitim Bitiş Tarihi *">Planned Training End Date *</label>
                                <input type="date" id="trainingEndDate" name="trainingEndDate" required>
                            </div>
                        </div>
                        <div class="container1">
                        <h3 style="border-bottom:2px solid #133e70;padding-bottom:5px;" data-en="The work to be done by the student" data-tr="Öğrenci Tarafından Yapılacak İşler">The work to be done by the student</h3>

                
                            <div class="checkbox-menu">
                        
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox1" name="workOptions[]" value="Developing Software">
                                    <label for="checkbox1" data-en="Developing Software" data-tr="Yazılım Geliştirme">Developing Software</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox2" name="workOptions[]" value="Operating System Installation and Maintenance">
                                    <label for="checkbox2" data-en="Operating System Installation and Maintenance" data-tr="İşletim Sistemi Kurulumu ve Bakımı">Operating System Installation and Maintenance</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox3" name="workOptions[]" value="Working as Part of a Team in a Large Software Project">
                                    <label for="checkbox3" data-en="Working as Part of a Team in a Large Software Project" data-tr="Büyük Yazılım Projesinde Ekip İçinde Çalışma">Working as Part of a Team in a Large Software Project</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox4" name="workOptions[]" value="Hardware Fault Diagnosis and Repairs">
                                    <label for="checkbox4" data-en="Hardware Fault Diagnosis and Repairs" data-tr="Donanım Arıza Teşhisi ve Onarımlar">Hardware Fault Diagnosis and Repairs</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox5" name="workOptions[]" value="Designing Web Pages">
                                    <label for="checkbox5" data-en="Designing Web Pages" data-tr="Web Sayfası Tasarımı">Designing Web Pages</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox6" name="workOptions[]" value="Developing a Web Application using ASP, .NET, PHP, etc.">
                                    <label for="checkbox6"  data-en="Developing a Web Application using ASP, .NET, PHP, etc." data-tr="ASP, .NET, PHP vb. Kullanarak Web Uygulaması Geliştirme">Developing a Web Application using ASP, .NET, PHP, etc.</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox7" name="workOptions[]" value="Designing/ Working with Databases">
                                    <label for="checkbox7" data-en="Designing/ Working with Databases" data-tr="Veritabanlarıyla Çalışma ve Tasarım">Designing/ Working with Databases</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox8" name="workOptions[]" value="Learning to Use Complex Company Software">
                                    <label for="checkbox8" data-en="Learning to Use Complex Company Software" data-tr="Karmaşık Şirket Yazılımlarını Kullanmayı Öğrenme">Learning to Use Complex Company Software</label>
                                </div>
                                <div class="checkbox-item">
                                    <input type="checkbox" id="checkbox9" name="workOptions[]" value="Network Installation and Maintenance">
                                    <label for="checkbox9" data-en="Network Installation and Maintenance" data-tr="Ağ Kurulumu ve Bakımı">Network Installation and Maintenance</label>
                                </div>
                                <br>
                                <b><label for="otherwork" data-en="others(if any):" data-tr="Diğerleri (varsa):">others(if any):</label></b>
                                <textarea id="otherwork" name="workOptions[]" rows="6" required></textarea>
                                <br>
                                <h3 style="border-bottom:2px solid #133e70;padding-bottom:5px;" data-en="Official Signature and Stamp of the Company" data-tr="Firmanın Resmi İmzası ve Damgası">Official Signature and Stamp of the Company</h3>
                                <br>
                                <div class="upload-box">
                                    <label for="file" data-en="Upload E-stamp:" data-tr="E-damgayı Yükle:">Upload E-stamp:</label>
                                    <input type="file" id="file1" name="file1">
                                </div>
                                <br>
                                <div class="upload-box">
                                    <label for="file" data-en="Upload E-signature:" data-tr="E-imzayı Yükle:">Upload E-signature:</label>
                                    <input type="file" id="file2" name="file2">
                                </div>
                                <br>
                                <button class="submitform" data-en="Submit" data-tr="Gönder">Submit</button>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </main>
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
