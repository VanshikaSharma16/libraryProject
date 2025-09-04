const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");
const body = document.body;
const storedTheme = localStorage.getItem('preferredTheme');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
})

// Check and apply the stored theme on page load
if (storedTheme) {
    body.classList.add(storedTheme);
}

themeToggler.addEventListener('click', () => {
    body.classList.toggle('dark-theme-variables');

    const isDarkTheme = body.classList.contains('dark-theme-variables');
    localStorage.setItem('preferredTheme', isDarkTheme ? 'dark-theme-variables' : '');
});

function showPopup() {
    document.getElementById('userDetailsPopup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('userDetailsPopup').style.display = 'none';
}