/* Popper initialization */

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

/* Sidebar */

const sidebarBtnEl = document.querySelector("#sidebarBtn");
const sidebarEl = document.querySelector("#sidebar");

sidebarBtnEl.addEventListener("click", () => {
    sidebarEl.classList.toggle("active");
});

const mediaQuery = "(min-width: 992px)";
const mediaQueryList = window.matchMedia(mediaQuery);

mediaQueryList.addEventListener("change", (e) => {
    if (e.matches) {
        sidebarEl.classList.remove("active");
    }
});

/* Theme toggler */

const themeSwitchEl = document.querySelector("#themeSwitch");
const htmlEl = document.querySelector("html");
let theme = localStorage.getItem("theme") ?? (window.matchMedia && window.matchMedia("(prefers-color-scheme: light)").matches ? "light" : "dark");

htmlEl.setAttribute("data-bs-theme", theme);
localStorage.setItem("theme", theme);

console.log(themeSwitchEl);
if (themeSwitchEl) {
    themeSwitchEl.checked = theme === "dark";

    const toggleTheme = (e) => {
        theme = e.target.checked ? "dark" : "light";
        htmlEl.setAttribute("data-bs-theme", theme);
        localStorage.setItem("theme", theme);
    };

    themeSwitchEl.addEventListener("click", toggleTheme);
}

