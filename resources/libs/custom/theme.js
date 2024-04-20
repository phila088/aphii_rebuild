(function () {
    "use strict"

    function toggleTheme() {
        let html = document.getElementsByTagName("html")
        if (html.getAttribute("data-theme-mode") === "dark") {
            html.setAttribute('data-theme-mode', 'light');
            html.setAttribute('data-header-styles', 'gradient');
            html.setAttribute('data-menu-styles', 'light');
        }
    }
})
