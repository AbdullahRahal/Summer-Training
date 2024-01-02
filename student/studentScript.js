// common script for all student site's pages

 // for user information
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


// script for Program page
// for company icon 
function showForm(formId) {
    const form = document.getElementById(formId);
    form.style.display = "block";
}

function hideForm(formId) {
    const form = document.getElementById(formId);
    form.style.display = "none";
}

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


//sort function
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
    const container = document.querySelector('.grid-container');
    const companyElements = Array.from(document.querySelectorAll('.grid-item'));

    if (!originalOrder) {
        originalOrder = companyElements.slice();
    }

    const sortedCompanies = companyElements.sort((a, b) => {
        const nameA = a.querySelector('h2').textContent;
        const nameB = b.querySelector('h2').textContent;
        return order === 'asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
    });

    container.innerHTML = '';
    sortedCompanies.forEach(company => container.appendChild(company));
    sort();
}

function sortCompanies(order) {
    const container = document.querySelector('.grid-container');
    const companyElements = Array.from(document.querySelectorAll('.grid-item'));

    if (!originalOrder) {
        originalOrder = companyElements.slice();
    }

    const sortedCompanies = companyElements.sort((a, b) => {
        const nameA = b.querySelector('h2').textContent;
        const nameB = a.querySelector('h2').textContent;
        return order === 'asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
    });
    
    container.innerHTML = '';
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


// filter script 
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

        // If 'other' is selected exclusively
        if (selectedCountries.includes('other') && selectedCountries.length === 1) {
            // Show items that are not from Turkey or TRNC
            item.style.display = (country !== 'turkey' && country !== 'trnc') ? 'block' : 'none';
        }
        // Condition for specific countries (excluding 'other')
        else if (selectedCountries.length > 0 && !selectedCountries.includes('other')) {
            // Show items that match the selected countries
            item.style.display = selectedCountries.includes(country) ? 'block' : 'none';
        }
        // If 'other' is selected along with specific countries
        else if (selectedCountries.includes('other')) {
            // Show all items except from Turkey and TRNC, plus any specifically selected countries
            item.style.display = (country !== 'turkey' && country !== 'trnc' || selectedCountries.includes(country)) ? 'block' : 'none';
        }
        // Show all items if no specific country or 'other' is selected
        else {
            item.style.display = 'block';
        }
    });
}



function getSelectedCheckboxValues(name) {
    const checkboxes = document.querySelectorAll(`input[name="${name}"]:checked`);
    return Array.from(checkboxes).map(checkbox => checkbox.id.replace(`${name}-`, ''));
}


// search script
document.getElementById('progSearch').addEventListener('input', searchGrid);

function searchGrid() {
    const searchInput = document.getElementById('progSearch').value.trim().toLowerCase();
    const gridItems = document.querySelectorAll('.grid-item');
    gridItems.forEach(item => {
        const h2Content = item.querySelector('h2').textContent.trim().toLowerCase();
        const h4Content = item.querySelector('h4').textContent.trim().toLowerCase();
        const pContent = item.querySelector('p').textContent.trim().toLowerCase();
        const isVisible = (h2Content.includes(searchInput) || h4Content.includes(searchInput) || pContent.includes(searchInput));
        item.style.display = isVisible ? 'block' : 'none';
    });
}


// script for apply page
// Function to trigger file download
function downloadFile(formType) {
    let fileName = '';
    switch (formType) {
        case 'application':
            fileName = 'application_form.pdf'; // Replace with your file name
            break;
        case 'confirmation':
            fileName = 'confirmation_form.pdf'; // Replace with your file name
            break;
        case 'insurance':
            fileName = 'insurance_form.pdf'; // Replace with your file name
            break;
    }
    // Simulate a file download by creating a temporary link
    const link = document.createElement('a');
    link.href = fileName;
    link.download = fileName;
    link.click();
}

// Function to submit the form
function submitForm(formType) {
    const statusElement = document.getElementById(`${formType}-status`);
    // Simulate form submission (replace with actual submission logic)
    setTimeout(() => {
        statusElement.innerText = `Form ${formType} submitted successfully.`;
    }, 2000); // Simulating a delay for submission
}

// Function to clear the form
function clearForm(formType) {
    const fileInput = document.getElementById(`${formType}-file`);
    const statusElement = document.getElementById(`${formType}-status`);
    // Clear file input and status
    fileInput.value = '';
    statusElement.innerText = '';
}