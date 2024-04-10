(function () {
    "use strict";


    /* header theme toggle */
    function toggleTheme() {
        let html = document.querySelector('html');
        if (html.getAttribute('data-theme-mode') === "dark") {
            html.setAttribute('data-theme-mode', 'light');
            html.setAttribute('data-header-styles', 'gradient');
            html.setAttribute('data-menu-styles', 'dark');
            html.removeAttribute('data-bg-theme');
            html.removeAttribute('data-default-header-styles');
            if (!localStorage.getItem("primaryRGB")) {
                html.setAttribute("style", "");
            }
            if (document.querySelector("#switcher-canvas")) {
                document.querySelector('#switcher-light-theme').checked = true;
                document.querySelector('#switcher-menu-light').checked = true;
            }
            document.querySelector('html').style.removeProperty('--body-bg-rgb', localStorage.bodyBgRGB);
            html.style.removeProperty('--light-rgb');
            html.style.removeProperty('--form-control-bg');
            html.style.removeProperty('--input-border');

            if (document.querySelector("#switcher-canvas")) {
                document.querySelector('#switcher-header-gradient').checked = true;
                document.querySelector('#switcher-menu-light').checked = true;
                document.querySelector('#switcher-light-theme').checked = true;
                document.querySelector("#switcher-background4").checked = false;
                document.querySelector("#switcher-background3").checked = false;
                document.querySelector("#switcher-background2").checked = false;
                document.querySelector("#switcher-background1").checked = false;
                document.querySelector("#switcher-background").checked = false;
            }
            localStorage.removeItem("velvetdarktheme");
            localStorage.removeItem("velvetMenu");
            localStorage.removeItem("velvetHeader");
            localStorage.removeItem("velvetDefaultHeader");
            localStorage.removeItem("bodylightRGB");
            localStorage.removeItem("bodyBgRGB");
            if (localStorage.getItem("velvetlayout") == "horizontal") {
                html.setAttribute("data-menu-styles", "gradient");
            }
            html.setAttribute("data-header-styles", "gradient");
        } else {
            html.setAttribute('data-theme-mode', 'dark');
            html.setAttribute('data-header-styles', 'gradient');
            html.setAttribute('data-menu-styles', 'dark');
            html.removeAttribute('data-default-header-styles');
            if (!localStorage.getItem("primaryRGB")) {
                html.setAttribute("style", "");
            }
            if (document.querySelector("#switcher-canvas")) {
                document.querySelector('#switcher-dark-theme').checked = true;
                document.querySelector('#switcher-menu-dark').checked = true;
                document.querySelector('#switcher-header-gradient').checked = true;
                document.querySelector('#switcher-menu-dark').checked = true;
                document.querySelector('#switcher-header-dark').checked = true;
                document.querySelector('#switcher-dark-theme').checked = true;
                document.querySelector("#switcher-background4").checked = false
                document.querySelector("#switcher-background3").checked = false
                document.querySelector("#switcher-background2").checked = false
                document.querySelector("#switcher-background1").checked = false
                document.querySelector("#switcher-background").checked = false
            }
            localStorage.setItem("velvetdarktheme", "true");
            localStorage.setItem("velvetMenu", "dark");
            localStorage.setItem("velvetHeader", "gradient");
            localStorage.removeItem("velvetDefaultHeader");
            localStorage.removeItem("bodylightRGB");
            localStorage.removeItem("bodyBgRGB");
        }
    }

    let layoutSetting = document.querySelector(".layout-setting")
    layoutSetting.addEventListener("click", toggleTheme);


    /* Choices JS */
    document.addEventListener('livewire:navigated', function () {
        var genericExamples = document.querySelectorAll('[data-trigger]');
        for (let i = 0; i < genericExamples.length; ++i) {
            var element = genericExamples[i];
            new Choices(element, {
                allowHTML: true,
                placeholderValue: 'This is a placeholder set in the config',
                searchPlaceholderValue: 'Search',
            });
        }
    });
    /* card with close button */
    let DIV_CARD = '.card';
    let cardRemoveBtn = document.querySelectorAll('[data-bs-toggle="card-remove"]');
    cardRemoveBtn.forEach(ele => {
        ele.addEventListener('click', function (e) {
            e.preventDefault();
            let $this = this;
            let card = $this.closest(DIV_CARD);
            card.remove();
            return false;
        })
    })
    /* card with close button */

    /* card with fullscreen */
    let cardFullscreenBtn = document.querySelectorAll('[data-bs-toggle="card-fullscreen"]');
    cardFullscreenBtn.forEach(ele => {
        ele.addEventListener('click', function (e) {
            let $this = this;
            let card = $this.closest(DIV_CARD);
            card.classList.toggle('card-fullscreen');
            card.classList.remove('card-collapsed');
            e.preventDefault();
            return false;
        });
    });
    /* card with fullscreen */

    /* count-up */
    var i = 1
    setInterval(() => {
        document.querySelectorAll(".count-up").forEach((ele) => {
            if (ele.getAttribute("data-count") >= i) {
                i = i + 1
                ele.innerText = i
            }
        })
    }, 10);
    /* count-up */
})();

/* full screen */
var elem = document.documentElement;
window.openFullscreen = function () {
    let open = document.querySelector('.full-screen-open');
    let close = document.querySelector('.full-screen-close');

    if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
        close.classList.add('block')
        close.classList.remove('hidden')
        open.classList.add('hidden')
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) { /* Safari */
            document.webkitExitFullscreen();
            console.log("working");
        } else if (document.msExitFullscreen) { /* IE11 */
            document.msExitFullscreen();
        }
        close.classList.remove('block')
        open.classList.remove('hidden')
        close.classList.add('hidden')
        open.classList.add('block')
    }
}
/* full screen */
