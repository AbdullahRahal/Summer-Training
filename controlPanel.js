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

// for displaying and hidding reject reason
// Application table
function rejectMessageApp(){
    event.preventDefault();
    var id = document.getElementById('rejectReason');
    if (id.style.display === "none" || id.style.display === "") {
        id.style.display = "block";
    } else {
        id.style.display = "none";
    }
}

// Confirmation table
function rejectMessageCon(){
    event.preventDefault();
    var id = document.getElementById('rejectReasonCon');
    if (id.style.display === "none" || id.style.display === "") {
        id.style.display = "block";
    } else {
        id.style.display = "none";
    }    
}

// logbook table
function rejectMessageLog(){
    event.preventDefault();
    var id = document.getElementById('rejectReasonLog');
    if (id.style.display === "none" || id.style.display === "") {
        id.style.display = "block";
    } else {
        id.style.display = "none";
    } 
}


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
createCompanyForm.style.display = "block";
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

function show_eva(reportId) {
    // Set the report ID in the hidden field
    document.getElementById('report_id').value = reportId;

    // Show the evaluation form
    var id = document.getElementById("eva_id");
    if (id.style.display === "none") {
        id.style.display = "block";
    } else {
        id.style.display = "none";
    }
}




//  sort script //

function sortTable(columnIndex, order) {
    var sortid = document.getElementById("sort");
    if (sortid.style.display === "none"){
        sortid.style.display = "block";
    }else {
        sortid.style.display = "none";
    }
    const table = document.querySelector('.internee-tables');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    const sortFunction = (a, b) => {
        const aValue = a.cells[columnIndex].textContent.trim();
        const bValue = b.cells[columnIndex].textContent.trim();

        if (order === 'asc') {
            return aValue.localeCompare(bValue);
        } else {
            return bValue.localeCompare(aValue);
    }
};

const sortedRows = rows.sort(sortFunction);

// Remove existing rows from the table
tbody.innerHTML = '';

// Append sorted rows to the table
sortedRows.forEach(row => tbody.appendChild(row));
}

function reSortName(order) {
sortTable(0, order);
}

function sortName(order) {
sortTable(0, order === 'asc' ? 'desc' : 'asc');
}

function reSortNo(order) {
sortTable(1, order);
}

function sortNo(order) {
sortTable(1, order === 'asc' ? 'desc' : 'asc');
}


// search bar script 

document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('searchInternee');
    var table = document.querySelector('.internee-tables');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});


// For application table search bar and show all
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('applySearch');
    var table = document.querySelector('.application-table');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});


// For application hidden table search bar 
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('applySearchHidden');
    var table = document.querySelector('.application-hidden-table');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

function showAllApply() {
    var div = document.querySelector('.hidden-apply');
    if (div.style.display === 'none'){
        div.style.display = 'block';
    }else{
        div.style.display = 'none';
    }
}


// For confirmation hidden table search bar and show all
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('conSearch');
    var table = document.querySelector('.confirmation-table');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('conSearchHidden');
    var table = document.querySelector('.confirmation-hidden-table');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

function showAllCon() {
    var div = document.querySelector('.hidden-con');
    if (div.style.display === 'none'){
        div.style.display = 'block';
    }else{
        div.style.display = 'none';
    }
}


function displayInfo(divId) {
    var div = document.getElementById(divId);
    if (div.style.display === 'none' || div.style.display === '') {
        div.style.display = 'block';
    } else {
        div.style.display = 'none';
    }
}
function displayInfo1(){
    var div = document.querySelector('.apply-file-nhidden');
    if (div.style.display === 'none' || div.style.display === ''){
        div.style.display = 'block';
    }else{
        div.style.display = 'none';
    }
}
function displayInfoApply(uniqueId) {
    var element = document.getElementById(uniqueId);
    if (element.style.display === "none") {
        element.style.display = "block";
    } else {
        element.style.display = "none";
    }
}


// logbook search bar for both
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('logSearch');
    var table = document.querySelector('.logbook-table-nhidden');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('logSearchHidden');
    var table = document.querySelector('.logbook-table-hidden');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

// logbook file displaying
function logbookfile(stdNum, stdName) {
    // Check if the student number and name are provided
    if (!stdNum || !stdName) {
        alert('Student number and name are required.');
        return;
    }

    // Define properties to keep track of the last viewed student
    if (typeof logbookfile.lastStdNum === 'undefined' || typeof logbookfile.lastStdName === 'undefined') {
        logbookfile.lastStdNum = null;
        logbookfile.lastStdName = null;
    }

    // Check if the details of the same student are already displayed
    if (stdNum === logbookfile.lastStdNum && stdName === logbookfile.lastStdName) {
        // Toggle the visibility of the details
        var detailsDiv = document.getElementById('logbookDetails');
        if (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') {
            detailsDiv.style.display = 'block';
        } else {
            detailsDiv.style.display = 'none';
        }
        return; // Return early since no new AJAX request is needed
    }

    // Update the last viewed student
    logbookfile.lastStdNum = stdNum;
    logbookfile.lastStdName = stdName;

    // Make the AJAX request to fetch new details
    var xhr = new XMLHttpRequest();
    var url = "std_logs.php?std_num=" + encodeURIComponent(stdNum) + "&std_name=" + encodeURIComponent(stdName);

    xhr.open("GET", url, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var detailsDiv = document.getElementById('logbookDetails');
            detailsDiv.innerHTML = xhr.responseText;
            detailsDiv.style.display = 'block'; // Ensure the details are visible
        } else {
            alert('Error fetching logbook details');
        }
    };
    xhr.send();
}


function hideLogbookDetails() {
    var detailsDiv = document.getElementById('logbookDetails');
    if (detailsDiv) {
        detailsDiv.style.display = 'none'; // This hides the div
    }
}





function evaluateResualt(){
    var div = document.querySelector('.hidden-eva-file');
    if (div.style.display === 'none' || div.style.display === ''){
        div.style.display = 'block';
    }else{
        div.style.display = 'none';
    }
}


function logbookDiv(){
    var div = document.querySelector('.hidden-log');
    if (div.style.display === 'none' || div.style.display === ''){
        div.style.display = 'block';
    }else{
        div.style.display = 'none';
    }
}

// report section displaying
function showReport(){
    var div = document.querySelector('.hidden-report');
    if (div.style.display === 'none' || div.style.display === ''){
        div.style.display = 'block';
    }else{
        div.style.display = 'none';
    }
}

function evaluatedRes(){
    var div = document.querySelector('.evaluate-div');
    if (div.style.display === 'none' || div.style.display === ''){
        div.style.display = 'block';
    }else{
        div.style.display = 'none';
    }
}

function displayInfoCom(conId) {
    console.log("displayInfoCom called with ID:", conId);

    var div = document.getElementById('info-' + conId);
    if (div) {
        div.style.display = 'block';
    } else {
        console.error('No div found for confirmation ID:', conId);
    }
}

// report search bar for both
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('reportSearch');
    var table = document.querySelector('.report-table');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('reportSearchHidden');
    var table = document.querySelector('.hidden-report-table');
    var rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        var searchTerm = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            var cells = row.querySelectorAll('td');
            var isMatch = false;

            cells.forEach(function (cell) {
                if (cell.textContent.toLowerCase().includes(searchTerm)) {
                    isMatch = true;
                }
            });

            if (isMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});