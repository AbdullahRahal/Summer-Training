<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    //Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}

// Fetch admin information from the session
$adminName = $_SESSION['admin_name'];
$adminEmail = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMU Internship - Control Panel</title>
    <link rel="stylesheet" href="controlPanelStyle.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="controlPanel.js" defer></script>
    <script src="translate.js" defer></script>
</head>
<body>
    <?php
    if (isset($_GET['registration']) && $_GET['registration'] == 'success') {
        echo "<script>alert('Student has been added successfully');</script>";
    }elseif (isset($_GET['registrationcs']) && $_GET['registrationcs'] == 'success') {
        echo "<script>alert('Supervisor has been added successfully');</script>";
    }
    ?>

    <header>
        <nav>
            <div id="logodiv">
                <div class="logo" class="headerdivs" id="logocss">
                    <img src="https://upload.wikimedia.org/wikipedia/en/thumb/b/b8/EMU_Cyprus.svg/300px-EMU_Cyprus.svg.png" alt="EMU Logo">
                </div>
                <div class="headerdivs">
                    <h2>EMU Internship - Control Panel</h2>
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
                                <td><?php echo $adminName; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $adminEmail; ?></td>
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
                    <a href="logout.php"><i class="fas fa-sign-out-alt banner-icons"></i></a>
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
        <div id="second-top-bar">
            <a data-en="announcement" data-tr="duyuru" href="#section-1">announcement</a>
            <a data-en="application" data-tr="uygulamalar" href="#section-2">application</a>
            <a data-en="confirmation" data-tr="Onayla" href="#section-9">confirmation</a>
            <a data-en="contact" data-tr="temas etmek" href="#section-3">contact</a>
            <a data-en="programs" data-tr="programlar" href="#section-4">programs</a>
            <a data-en="create account" data-tr="hesap oluşturmak" href="#section-5">create account</a>
            <a data-en="logbook" data-tr="seyir defteri" href="#section-7">logbook</a>
            <a data-en="report & evaluation" data-tr="rapor & değerlendirme" href="#section-6">report & evaluation</a>
        </div>
    </header>
        <main class="main-sec">
            <!--  section 1 - announcement  -->
            <section id="section-1">
                <h1 data-en="announcement" data-tr="duyuru" class="sec-h1">announcements</h1>
                <div id="cards-container">
                    <div class="cards">
                        <div class="cards-header">
                            <h1 data-en="active announcement" data-tr="aktif duyuru" >active announcement</h1>
                        </div>
                        <div class="detail-container">
                            <ul class="Announcement-list">
                                <?php include 'display_announcements.php'; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="cards">
                        <div class="cards-header">
                            <h1 data-en="add announcement" data-tr="duyuru ekle" >add announcement</h1>
                        </div>
                        <div class="detail-container">
                            <form action="add_announcement.php" method="POST">
                                <div class="add-div">
                                    <textarea name="add-ann-area" class="add-ann-area" id="addAnnArea" placeholder="write an announcement...." cols="30" rows="14"></textarea>
                                    <button data-en="add" data-tr="eklemek" type="submit" name="addAnnouncementButton" id="addAnnouncementButton" class="add-announcement-button">add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <!-- section 2 -->
        <section class="sec-2" id="section-2">
            <h1 class="sec-h1" data-en="Application form" data-tr="Başvuru Formu">Application form</h1>
            <div class="container-back">
                <div class="top-forms">
                    <input type="search" name="" id="applySearch" class="search-internee" placeholder="Search...">
                    <button type="button" onclick="showAllApply()" data-en="show all" data-tr="Hepsini Göster ↓">show all</button>
                </div>
                <div class="table-container">
                    <form action="" method="">
                        <table id="approve-reject-view" class="application-table">
                            <thead>
                                <tr>
                                    <th data-en="student name" data-tr="Öğrenci adı">Student Name</th>
                                    <th data-en="Student Number" data-tr="Öğrenci Numarası">Student Number</th>
                                    <th data-en="File" data-tr="Dosya">File</th>
                                    <th class="action-cell" data-en="Actions" data-tr="eylemler düğmeleri">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include 'appforms.php'; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <script>
                function updateStatus(studentId, status) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "update_status.php", true); // Path to your PHP script
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            alert(this.responseText); // Display response message

                            // Refresh the page or redirect
                            window.location.href = 'controlPanelhtml.php'; // Redirect to controlPanelhtml.php
                            // or use window.location.reload(); to simply refresh the current page
                        }
                    }

                    xhr.send("id=" + studentId + "&status=" + status);
                }
            </script>


 
            <div class="container-back hidden-apply">
                <div class="table-container">
                    <div class="top-forms">
                        <input type="search" name="" id="applySearchHidden" class="search-internee" placeholder="Search...">
                        <button data-en="student name" data-tr="saklamak" type="button" onclick="showAllApply()">hide</button>
                    </div>
                        <table id="approve-reject-view" class="application-hidden-table">
                            <thead>
                                <tr>
                                    <th data-en="student name" data-tr="Öğrenci adı">Student Name</th>
                                    <th data-en="Student Number" data-tr="Öğrenci Numarası">Student Number</th>
                                    <th data-en="File" data-tr="Dosya">File</th>
                                    <th class="action-cell" data-en="Actions" data-tr="eylemler düğmeleri">Actions</th>
                                </tr>
                            </thead>
                            <?php include 'appformsall.php'; ?>
                        </table>
                </div>
            </div>
        </section>
        
 
        <!-- section 9 -->
        <section class="sec-2" id="section-9">
            <h1 class="sec-h1" data-en="confirmation forms" data-tr="onay formları">confirmation forms</h1>
            <div class="container-back">
                <div class="top-forms">
                    <input type="search" name="" id="conSearch" class="search-internee" placeholder="Search...">
                </div>
                <div class="table-container">
                        <table id="approve-reject-view" class="confirmation-table">
                            <thead>
                                <tr>
                                    <th data-en="Supervisor Name" data-tr="Süpervizör Adı" >Supervisor Name</th>
                                    <th data-en="Company Name" data-tr="Firma Adı" >Company Name</th>
                                    <th data-en="File" data-tr="Dosya" >File</th>
                                    <th class="action-cell" data-en="Actions" data-tr="eylemler düğmeleri">Actions</th>
                                </tr>
                            </thead>
                            <?php include'fetch_con.php' ?>
                        </table>
                </div>
            </div>
            <script>
                function updateState(conId, newState) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "update_confirmation_state.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(this.responseText);
                            location.reload(); // Reloads the page to reflect changes
                        }
                    };
                    xhr.send("con_id=" + conId + "&new_state=" + newState);
                }
            </script>
        </section>
        <script>
            console.log("JavaScript loaded"); // Confirm that the script is loaded

            function displayInfoCom(conId) {
                console.log("displayInfoCom called with ID:", conId);

                var div = document.getElementById('info-' + conId);
                if (div) {
                    console.log("Found div for ID:", conId);
                    div.style.display = 'block'; // Just set it to block for testing
                } else {
                    console.error('No div found for confirmation ID:', conId);
                }
            }
        </script>

                    

            <!-- section 3 -->
            <section class="sec-3" id="section-3">
                <h1 class="sec-h1" data-en="contact information" data-tr="iletişim bilgileri" >contact information</h1>
                <div class="container-back">
                    <form action="add_contact.php" method="post" class="add-contact-form">
                        <input required type="text" class="con-input" placeholder="Name & surname" name="name">
                        <input required type="email" class="con-input" placeholder="ex: example@emu.edu.tr" name="email">
                        <input required type="text" class="con-input" placeholder="Office Number" name=" office number">
                        <button type="submit" class="con-btn" name="addcontact" data-en="add contact" data-tr="kişi ekle" >add contact</button>
                    </form>
                    <div class="table-container-contact">
                        <div>
                            <form action="" method="POST">
                                <table class="contact-table">
                                    <thead>
                                        <tr>
                                            <th data-en="Name" data-tr="İsim" >Name</th>
                                            <th data-en="E-Mail" data-tr="E-Posta" >E-Mail</th>
                                            <th data-en="Office Number" data-tr="Ofis numara" >Office Number</th>
                                            <th class="action-cell" data-en="Actions" data-tr="eylemler düğmeleri">Actions</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            <?php include 'display_contacts.php'; ?>
                                        </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <script type="text/javascript">
                function enableEditMode(cid) {
                    var form = document.getElementById('company' + cid + '-form');
                    var inputs = form.querySelectorAll('.editable');
                    inputs.forEach(function(input) {
                        input.removeAttribute('readonly');
                    });

                    // Show save button, hide edit button
                    form.querySelector('.save-btn').style.display = 'block';
                    form.querySelector('.edit-btn').style.display = 'none';
                }
            </script>

            <!-- section 4 - Programs -->
            <section id="section-4">
                <h1 class="sec-h1" data-en="programs" data-tr="programlar">programs</h1>
                <div class="container-back">
                        <!-- Button to show the form for creating a new company -->
                        <div class="grid-container">
                            <div class="grid-item" onclick="showCreateCompanyForm('create-company-form')">
                                <h1>+</h1>
                                <h3 data-en="New Company" data-tr="Yeni Şirket">New Company</h3>
                            </div>
                            <?php include 'display_companies.php'; ?>
                        </div>
                            <!-- Form for creating a new company -->
                            <form action="create_company.php" method="POST" id="create-company-form" class="hidden-form">
                                <h1 data-en="Create New Company" data-tr="Yeni Şirket Oluştur">Create New Company</h1>
                                <div class="form-columns">
                                    <!-- Left Column - Company Information -->
                                    <div class="form-column">
                                        <div class="form-field">
                                            <label for="company-name" data-en="Company Name" data-tr="Firma Adı">Company Name</label>
                                            <input type="text" id="company-name" name="company-name" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="workField" data-en="Working Field(s)" data-tr="Çalışma Alan(lar)ı">Working Field(s)</label>
                                            <input type="text" id="workField" name="workField" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="Website" data-en="Website" data-tr="İnternet sitesi">Website</label>
                                            <input type="url" id="Website" name="Website" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="country" data-en="Country" data-tr="Ülke">Country</label>
                                            <input type="text" id="country" name="country" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="description" data-en="Work to be done" data-tr="Yapılacak iş">Work to be done</label>
                                            <textarea id="description" name="description" rows="4" class="create-com-textarea" required></textarea>
                                        </div>
                                    </div>

                                    <!-- Right Column - Role Information -->
                                    <div class="form-column">
                                        <div class="form-field">
                                            <label for="phone-number" data-en="Phone Number" data-tr="Telefon numarası">Phone Number</label>
                                            <input type="text" id="phone-number" name="phone-number" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="email" data-en="E-Mail" data-tr="E-Posta">E-Mail</label>
                                            <input type="email" id="email" name="email" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="Fax" data-en="Fax" data-tr="Faks">Fax</label>
                                            <input type="text" id="Fax" name="Fax" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="duration" data-en="Duration" data-tr="Süre">Duration</label>
                                            <input type="number" id="duration" name="duration" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="address" data-en="Address" data-tr="Adres">Address</label>
                                            <textarea id="address" name="address" rows="4" class="create-com-textarea" required></textarea>
                                        </div>
                                    </div>

                                    <!-- Third column - Company Supervisor -->
                                    <div class="form-column super">
                                        <h3 data-en="Company Supervisor" data-tr="Şirket Sorumlusu">Company Supervisor</h3>
                                        <div class="form-field">
                                            <label for="first-name" data-en="First Name" data-tr="İlk adı">First Name</label>
                                            <input type="text" id="firstName" name="first-name" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="last-name" data-en="Last Name" data-tr="Soy isim">Last Name</label>
                                            <input type="text" id="lastName" name="last-name" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="sup-email"data-en="E-Mail" data-tr="E-Posta">E-Mail</label>
                                            <input type="email" id="supEmail" name="sup-email" class="create-com-input" required>
                                        </div>
                                        <div class="form-field">
                                            <label for="supPosition" data-en="His/Her Position" data-tr="Onun Pozisyonu">His/Her Position</label>
                                            <input type="text" id="supPosition" name="supPosition" class="create-com-input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="reset" data-en="Reset" data-tr="Sıfırla">Reset</button>
                                    <button type="submit" name="createCompanyForm" data-en="Create" data-tr="Yaratmak">Create</button>
                                    <button type="button" onclick="hideForm('create-company-form')" data-en="Cancel" data-tr="İptal etmek">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>


            <!-- section 5 -->
            <section class="sec-5" id="section-5">
                <h1 class="sec-h1">create an Account</h1>
                <div class="sec5-container">
                    <div class="boxes">
                        <h3>student</h3>
                        <form action="register_student.php" method="post">
                            <table class="register-table">
                                <tr>
                                    <th><label for="full-name">full name</label></th>
                                    <td><input type="text" name="std_name" id="fullName"></td>
                                </tr>
                                <tr>
                                    <th><label for="std-no">student no</label></th>
                                    <td><input type="number" name="std_num" id="stdNo"></td>
                                </tr>
                                <tr>
                                    <th><label for="std-gender">academic semester</label></th>
                                    <td><select name="academic_semester" class="sem-sel">
                                            <option value="1st Semester">1st Semester</option>
                                            <option value="2nd Semester">2nd Semester</option>
                                            <option value="3rd Semester">3rd Semester</option>
                                            <option value="4th Semester">4th Semester</option>
                                            <option value="5th Semester">5th Semester</option>
                                            <option value="6th Semester">6th Semester</option>
                                            <option value="7th Semester">7th Semester</option>
                                            <option value="8th Semester">8th Semester</option>
                                        </select>
                                    </td>
                                </tr>   
                                <tr>
                                    <th><label for="std-dept">department</label></th>
                                    <td><input type="text" name="std_department" id="stdDept"></td>
                                </tr>
                                <tr>
                                    <th><label for="std-email">e-mail</label></th>
                                    <td><input type="email" name="std_email" id="stdEmail"></td>
                                </tr>
                                <tr>
                                    <th><label for="std-pwd">password</label></th>
                                    <td><input type="password" name="std_password" id="stdPwd"></td>
                                </tr>
                            </table>

                            <button type="submit" class="add-announcement-button">register</button>

                        </form>
                    </div>
                    <div  class="boxes">
                        <h3>supervisor</h3>
                        <form action="regester_CS.php" method="post">
                            <table class="register-table">
                                <tr>
                                    <th><label for="supName">full name</label></th>
                                    <td><input type="text" name="sup_name" id="supName"></td>
                                </tr>
                                <tr>
                                    <th><label for="email">e-mail</label></th>
                                    <td><input type="email" name="email" id="email"></td>
                                </tr>
                                <tr>
                                    <th><label for="supPwd">password</label></th>
                                    <td><input type="password" name="sup_pwd" id="supPwd"></td>
                                </tr>
                                <tr>
                                    <th><label for="phone">phone</label></th>
                                    <td><input type="text" name="phone" id="phone"></td>
                                </tr>
                                <tr>
                                    <th><label for="supCom">company name</label></th>
                                    <td><input type="text" name="sup_com" id="supCom"></td>
                                </tr>
                                <tr>
                                    <th><label for="position">position</label></th>
                                    <td><input type="text" name="position" id="position"></td>
                                </tr>
                            </table>

                            <button type="submit" class="add-announcement-button">register</button>
                        </form>

                    </div>
                </div>

                

                <div class="internee-container">
                    <h2>search for account info</h2>
                    <input type="search" name="search_internee" id="searchInternee" class="search-internee" placeholder="Search...">
                    <div class="dropsort">
                        <button onclick="sortTable()" class="sortbtn">Sort By</button>
                        <div id="sort" class="dropdown-op">
                          <a onclick="sortName()">Name: A-Z</a>
                          <a onclick="reSortName()">Name: Z-A</a>
                          <a onclick="sortNo()">student no: 0-9</a>
                          <a onclick="reSortNo()">student no: 9-0</a>
                        </div>
                    </div>
                    <div class="internee-div">
                        <table class="internee-tables">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>student no</th>
                                    <th>e-mail</th>
                                    <th>academic semester</th>
                                    <th>department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include'accounts_featch.php'?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
<!-- section 7 -->
<section class="sec-2" id="section-7">
            <h1 class="sec-h1">Logbook Submition</h1>
            <div class="container-back">
                <div class="top-forms">
                    <input type="search" name="" id="logSearch" class="search-internee" placeholder="Search...">
                </div>
                <div class="logbook-table">
                    <form actilogbook-tableon="" method="">
                        <table id="" class="logbook-table-nhidden">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Student Number</th>
                                    <th>Department</th>
                                    <th>File</th>
                                    <th>Evaluation</th>
                                    <th class="action-cell">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include 'logbooks_eva.php';?>
                            </tbody>
                        </table>
                       
                        <!-- below is the logbook file -->
                        <div class="logbook-file-container">
                            <div class="logbook-file-div">
                                <?php include 'std_logs.php'; ?>   
                            </div>
                            <button type="button" onclick="logbookfile()">close</button>    
                        </div>
                        <div id="logbookDetails">
                        </div>
                        <div class="hidden-eva-file" style="display:none;">
                            <div class="view-logbook">
                                <div class="sides-log">
                                    <h3>Evaluation Criteria</h3>
                                    <p>Interest: <input type="text" id="eva1"></p>
                                    <p>Attendance: <input type="text" id="eva2"></p>
                                    <p>Technical Knowledge and Ability: <input type="text" id="eva3"></p>
                                    <p>General Behavior: <input type="text" id="eva4"></p>
                                    <p>Overall Evaluation Result: <input type="text" id="eva5"></p>
                                    <h4>General comments:</h4>
                                    <p><textarea id="comment"></textarea></p>
                                </div>
                                <div class="sides-log">
                                    <h3>Supervisor Grade</h3>
                                    <p><input type="text" id="eva_state"></p>
                                    <h4>Summary of the work done:</h4>
                                    <p><textarea id="summary"></textarea></p>
                                </div>
                            </div>
                            <button type="button" onclick="evaluateResualt()">Cancel</button>
                        </div>

                    </form>
                    <div id="evaluation-container" style="display: none;"></div>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function fetchEvaluationData(event, stdNum, stdName) {
                event.preventDefault();
                $.ajax({
                    url: 'fetch_evaluation.php',
                    type: 'GET',
                    data: {
                        'std_num': stdNum,
                        'std_name': stdName
                    },
                    success: function(response) {
                        if(response.error) {
                            alert('Error: ' + response.error);
                            return;
                        }
                        // Populate the fields
                        $('#eva1').val(response.eva1);
                        $('#eva2').val(response.eva2);
                        $('#eva3').val(response.eva3);
                        $('#eva4').val(response.eva4);
                        $('#eva5').val(response.eva5);
                        $('#summary').val(response.summary);
                        $('#comment').val(response.comment);
                        $('#eva_state').val(response.eva_state);

                        // Display the hidden evaluation form
                        $('.hidden-eva-file').show();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + error);
                    }
                });
            }

            function updateEvaluationStatus(stdNum, stdName, status) {
                $.ajax({
                    url: 'update_evaluation.php',
                    type: 'POST',
                    data: {
                        'std_num': stdNum,
                        'std_name': stdName,
                        'eva_state': status
                    },
                    success: function(response) {
                        alert(response);
                        // Refresh the page to reflect the changes
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + error);
                    }
                });
            }


        </script>

    
    
            <!-- section 6 -->
            <section class="sec-6" id="section-6">
                <h1 class="sec-h1">report submition</h1>
                <div class="container-back">
                    <div class="top-forms">
                        <input type="search" name="" id="reportSearch" class="search-internee" placeholder="Search...">
                    </div>
                    <div class="eva-div">
                        <form class="evaluate-form" id="eva_id" action="report_eva_submit.php" method="POST">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Evaluation Criteria</th>
                                        <th>Poor</th>
                                        <th>Fair</th>
                                        <th>Good</th>
                                        <th>Excellent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Quality of the report and the compatibility of the work done with the logbook</td>
                                        <td><input type="radio" name="quality"value="poor" required></td>
                                        <td><input type="radio" name="quality"value="fair" required></td>
                                        <td><input type="radio" name="quality"value="good" required></td>
                                        <td><input type="radio" name="quality" value="excellent" required></td>
                                    </tr>
                                    <tr>
                                        <td>The student has done IT-related work or applied IT knowledge to some task</td>
                                        <td><input type="radio" name="it-work"value="poor" required></td>
                                        <td><input type="radio" name="it-work"value="fair" required></td>
                                        <td><input type="radio" name="it-work"value="good" required></td>
                                        <td><input type="radio" name="it-work" value="excellent" required></td>
                                    </tr>
                                    <tr>
                                        <input type="hidden" name="report_id" id="report_id" value="">
                                        <td>Knowledge of the student during presentation</td>
                                        <td><input type="radio" name="knowledge"value="poor" required></td>
                                        <td><input type="radio" name="knowledge"value="fair" required></td>
                                        <td><input type="radio" name="knowledge"value="good" required></td>
                                        <td><input type="radio" name="knowledge" value="excellent" required></td>
                                    </tr>
                                    <tr>
                                        <td>Answering questions during the presentation</td>
                                        <td><input type="radio" name="answering"value="poor" required></td>
                                        <td><input type="radio" name="answering"value="fair" required></td>
                                        <td><input type="radio" name="answering"value="good" required></td>
                                        <td><input type="radio" name="answering" value="excellent" required></td>
                                    </tr>
                                    <tr>
                                        <td>Overall Evaluation Result</td>
                                        <td><input type="radio" name="overall" value="Unsatisfactory"> Unsatisfactory</td>
                                        <td><input type="radio" name="overall" value="Satisfactory"> Satisfactory</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>General Comments:</td>
                                        <td colspan="4"><textarea name="comments"></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="submit" value="Submit" id="evaSubmit" onclick="show_eva()">
                            <button type="button" id="evaCancel" onclick="show_eva()">cancel</button>
                        </form>
                    </div>
                    <div class="internee-div r-table">
                        <table class="internee-tables sub-table report-table">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>student no</th>
                                    <th>department</th>
                                    <th>report</th>
                                    <th>evaluation</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php include 'displayreports.php'; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    <script>

        // section 4 script 

    // Function to show a hidden form by its ID
    function showForm(formId) {
        const form = document.getElementById(formId);
        form.style.display = "block";
    }

    // Function to hide a visible form by its ID
    function hideForm(formId) {
        const form = document.getElementById(formId);
        form.style.display = "none";
    }

    // Function to show the create company form
    function showCreateCompanyForm() {
        const createCompanyForm = document.getElementById('create-company-form');
        createCompanyForm.style.display = "block";n-7
    }

    // Function to edit a company (you can implement this as needed)
    function editCompany(formId) {
        // Add your logic to edit the company information here
        console.log(`Editing company with form ID: ${formId}`);
    }

    // Function to delete a company (you can implement this as needed)
    function deleteCompany(formId) {
        // Add your logic to delete the company here
        console.log(`Deleting company with form ID: ${formId}`);
    }
    //delete announcement buttun function:
    function confirmDelete(announcementId) {
        if (confirm('Are you sure you want to delete this announcement?')) {
            // Manually submit the form
            var form = document.createElement('form');
            form.method = 'post';
            form.action = ''; // Add your form action URL
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_announcement';
            input.value = announcementId;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }

    </script>
</body>
</html>