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
    <title>Programs</title>
    <link rel="stylesheet" href="programStyle.css" type="text/css">
    <link rel="stylesheet" href="pagesStyle.css" type="text/css">
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
            <div class="prog-all-container">
                <div id="top-part">
                    <h1 style="border-bottom:2px solid #133e70;padding-bottom:5px;">available internships</h1>
                    <input type="search" name="prog-search" id="progSearch" class="progSearch" placeholder="Search...">
                    
                    <div class="dropsort">
                        <button onclick="sort()" class="sortbtn">Sort By</button>
                        <div id="sortDropdown" class="dropdown-op">
                            <a href="#" onclick="restoreOriginalOrder()">No Sort</a>
                            <a href="#" onclick="sortCompanies()">Name: A-Z</a>
                            <a href="#" onclick="resortCompanies()">Name: Z-A</a>
                        </div>
                    </div>

                    <button type="button" name="prog-filter-btn" id="progfilterBtn" onclick="filter()">filter</button>
                    <div class="filter-div" id="filterDiv">
                        <h2>filter</h2>
                        <div class="lan-div">
                            <h4>country:</h4>
                            <input type="checkbox" name="con" id="con-turkey" value="turkey">Turkey
                            <input type="checkbox" name="con" id="con-trnc" value="trnc">TRNC
                            <input type="checkbox" name="con" id="con-other" value="other">Other
                        </div>    
                        <button type="button" onclick="applyFilter()">apply</button>
                    </div>

                    <p>*click on the box to see all the information about the company</p>
                </div>
                <div class="grid-container">
                <?php include 'fetch_companies.php'; ?>
                </div>
            </div>
        </main>
    </div>
    <!-- <script>
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
        
    // for company icon 
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


    // showing apply form after clicking on APPLY button
    function showApply(){
        var id = document.getElementById('applyDiv');
        if(id.style.display == 'none'){
            id.style.display = 'block';
        }else{
            id.style.display = 'none';
            
        }
    }
    function showApplyForm(){
        var id = document.getElementById('applyDiv');
        if(id.style.display == 'none'){
            id.style.display = 'block';
        }else{
            id.style.display = 'none';
            document.getElementById('company1-form').style.display = 'none';   
        }
    }
    function cancelApplyForm(){
        document.getElementById('applyDiv').style.display = 'none';
    }


    ///////// sort function///////////////

    // Variable to store the original order
    let originalOrder;

    function sort() {
        var id = document.getElementById('sortDropdown');
        if (id.style.display == 'none') {
            id.style.display = 'block';
        } else {
            id.style.display = 'none';
        }
    }

    function resortCompanies(order) {
        // Get the parent container
        const container = document.querySelector('.grid-container');

        // Get all company elements
        const companyElements = Array.from(document.querySelectorAll('.grid-item'));

        // Store the original order if not already stored
        if (!originalOrder) {
            originalOrder = companyElements.slice(); // Create a copy
        }

        // Sort the companies based on company names
        const sortedCompanies = companyElements.sort((a, b) => {
            const nameA = a.querySelector('h2').textContent;
            const nameB = b.querySelector('h2').textContent;

            return order === 'asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
        });

        // Remove existing elements from the container
        container.innerHTML = '';

        // Append sorted companies to the container
        sortedCompanies.forEach(company => container.appendChild(company));

        sort();
    }

    function sortCompanies(order) {
        // Get the parent container
        const container = document.querySelector('.grid-container');

        // Get all company elements
        const companyElements = Array.from(document.querySelectorAll('.grid-item'));

        // Store the original order if not already stored
        if (!originalOrder) {
            originalOrder = companyElements.slice(); // Create a copy
        }

        // Sort the companies based on company names
        const sortedCompanies = companyElements.sort((a, b) => {
            const nameA = b.querySelector('h2').textContent;
            const nameB = a.querySelector('h2').textContent;

            return order === 'asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
        });

        // Remove existing elements from the container
        container.innerHTML = '';

        // Append sorted companies to the container
        sortedCompanies.forEach(company => container.appendChild(company));

        sort();
    }

    function restoreOriginalOrder() {
        const container = document.querySelector('.grid-container');
        
        var i = 0;
        if (i == 0){
            originalOrder.forEach(company => container.appendChild(company));
            i++;
        }
        sort();
    }


    /////  filter script /////
    
    function filter(){
        var id = document.getElementById('filterDiv');
        if(id.style.display == 'none'){
            id.style.display = 'block';
        }else{
            id.style.display = 'none';
        }
    }

    function applyFilter() {
    document.getElementById('filterDiv').style.display = 'none';

    const selectedCountries = getSelectedCheckboxValues('con');

    const gridItems = document.querySelectorAll('.grid-item');

    gridItems.forEach(item => {
        const country = item.querySelector('h4').textContent.trim().toLowerCase();

        if (selectedCountries.length === 0 || (selectedCountries.includes('other') && !selectedCountries.includes(country))) {
            // If no countries are selected or only 'Other' is selected, display all items
            item.style.display = 'block';
        }else if (selectedCountries.includes(country) || (country === 'turkey' && selectedCountries.includes('other')) || (country === 'trnc' && selectedCountries.includes('other'))) {
            // Show the item if the selected countries include the current country or if 'Other' is selected along with 'Turkey' or 'TRNC'
            item.style.display = 'block';
        }else {
            // Hide the item for all other cases
            item.style.display = 'none';
        }
    });
}



    function getSelectedCheckboxValues(name) {
        const checkboxes = document.querySelectorAll(`input[name="${name}"]:checked`);
        return Array.from(checkboxes).map(checkbox => checkbox.id.replace(`${name}-`, ''));
    }

    //// search script /////

    document.getElementById('progSearch').addEventListener('input', searchGrid);

    function searchGrid() {
        const searchInput = document.getElementById('progSearch').value.trim().toLowerCase();
        const gridItems = document.querySelectorAll('.grid-item');

        gridItems.forEach(item => {
            const h2Content = item.querySelector('h2').textContent.trim().toLowerCase();
            const h4Content = item.querySelector('h4').textContent.trim().toLowerCase();
            const pContent = item.querySelector('p').textContent.trim().toLowerCase();

            const isVisible = (
                h2Content.includes(searchInput) ||
                h4Content.includes(searchInput) ||
                pContent.includes(searchInput)
            );

            item.style.display = isVisible ? 'block' : 'none';
        });
    }
    </script> -->
</body>
</html>