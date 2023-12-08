/* Popper initialization */

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

/* Offcanvas fix */

const mediaQuery = "(min-width: 992px)";
const mediaQueryList = window.matchMedia(mediaQuery);
const offcanvasSidebarEl = document.querySelector("#offcanvasSidebar");

if (offcanvasSidebarEl) {
    const offcanvas = new bootstrap.Offcanvas("#offcanvasSidebar");

    mediaQueryList.addEventListener("change", (e) => {
        if (e.matches) {
            offcanvas.hide();
        }
    });

}

/* Theme toggler */

const themeTogglerEl = document.querySelector("#themeToggler");
const htmlEl = document.querySelector("html");
let theme = localStorage.getItem("theme") ?? (window.matchMedia && window.matchMedia("(prefers-color-scheme: light)").matches ? "light" : "dark");

htmlEl.setAttribute("data-bs-theme", theme);
localStorage.setItem("theme", theme);
themeTogglerEl.checked = theme === "dark";

const toggleTheme = (e) => {
    theme = e.target.checked ? "dark" : "light";
    htmlEl.setAttribute("data-bs-theme", theme);
    localStorage.setItem("theme", theme);
};

themeTogglerEl.addEventListener("click", toggleTheme);
