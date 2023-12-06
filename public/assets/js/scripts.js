/* Popper initialization */

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

/* Offcanvas fix */

const mediaQuery = "(min-width: 992px)";
const mediaQueryList = window.matchMedia(mediaQuery);
const offcanvas = new bootstrap.Offcanvas("#offcanvasSidebar");
mediaQueryList.addEventListener("change", (e) => {
    console.log("change");

    if (e.matches) {
        offcanvas.hide();
    }
});