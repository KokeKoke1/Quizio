const btnLog = document.querySelector(".btnLog");
const btnprofile = document.querySelector(".btnprofile");
const profilemenu = document.querySelector(".profilemenu");
const jumbotron = document.querySelector(".jumbotron");

if (btnLog != null) {
    btnLog.addEventListener("click", () => {
        document.location.search = "?login";
    });
}
if (btnprofile !=null) {
    btnprofile.addEventListener("click", () => {
        if (profilemenu.style.transform == "translate(28%, -9px)") {
            profilemenu.style.transform = "translate(28%, -500%)";
        } else {
            profilemenu.style.transform = "translate(28%, -9px)";
        }
    });
}
if (jumbotron !=null) {

    window.addEventListener("load", () => {
        setTimeout(() => {
            let jumbotext = document.querySelector(".jumbotron > .text");
            jumbotext.style.transform = "translate(0)";
        },100);
    })
    document.addEventListener("scroll", () => {
        let items = document.querySelector(".container").querySelectorAll(".items");
        if (window.scrollY > 250) {
            items[0].classList.remove("hiddenScroll-left");
            items[1].classList.remove("hiddenScroll-right");
        }
        if (window.scrollY > 850) {
            items[2].classList.remove("hiddenScroll-left");
            items[3].classList.remove("hiddenScroll-right");
        }
        if (window.scrollY > 1350) {
            items[4].classList.remove("hiddenScroll-left");
            items[5].classList.remove("hiddenScroll-right");
        }
    });
}
