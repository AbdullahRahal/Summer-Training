document.addEventListener('DOMContentLoaded', function () {
    // Default language
    let currentLanguage = localStorage.getItem('selectedLanguage') || 'en';

    // Function to update content based on the selected language
    function updateContent() {
        document.querySelectorAll('[data-en], [data-tr]').forEach(function (element) {
            const key = element.getAttribute('data-' + currentLanguage);
            element.innerText = key;
        });
    }

    // Function to handle language selection change
    function handleLanguageChange() {
        const languageSelect = document.getElementById('language-select');
        currentLanguage = languageSelect.value;
        localStorage.setItem('selectedLanguage', currentLanguage);
        updateContent();
    }

    // Event listener for language select change
    document.getElementById('language-select').addEventListener('change', function () {
        handleLanguageChange();
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        const languageSelect = document.getElementById('language-select');
        if (event.target !== languageSelect) {
            // Close the language select if it's open
            languageSelect.blur();
        }
    });

    // Initial content update
    updateContent();
});


