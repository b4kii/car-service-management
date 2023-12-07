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