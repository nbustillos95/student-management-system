//
//
//alert("Hello, World!");

function confirmDelete() {
    return confirm("Are you sure you want to delete this student?");
}


// JavaScript to handle theme switching
const themeToggle = document.getElementById('themeToggle');
const currentTheme = document.body.className;

themeToggle.addEventListener('click', () => {
    const newTheme = document.body.classList.contains('light-theme') ? 'dark-theme' : 'light-theme';
    document.body.className = newTheme;

    // Save the theme preference in a cookie
    document.cookie = `theme=${newTheme}; path=/;`;
});
