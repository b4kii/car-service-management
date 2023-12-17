/* Popper initialization */

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

/* Theme toggler */

const themeSwitchEl = document.querySelector("#themeSwitch");
const htmlEl = document.querySelector("html");
let theme = localStorage.getItem("theme") ?? (window.matchMedia && window.matchMedia("(prefers-color-scheme: light)").matches ? "light" : "dark");

htmlEl.setAttribute("data-bs-theme", theme);
localStorage.setItem("theme", theme);

if (themeSwitchEl) {
    themeSwitchEl.checked = theme === "dark";

    const toggleTheme = (e) => {
        theme = e.target.checked ? "dark" : "light";
        htmlEl.setAttribute("data-bs-theme", theme);
        localStorage.setItem("theme", theme);
    };

    themeSwitchEl.addEventListener("click", toggleTheme);
}

