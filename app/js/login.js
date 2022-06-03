const loginbtn = document.querySelector(".loginbtn");
const loginField = document.querySelector("input[name=Lemail]");
const passwordField = document.querySelector("input[name=Lpassword]");
const errorField = document.querySelector(".error");

loginbtn.addEventListener("click", () => {
    fetch(`app/functions/api/account.php?email=${loginField.value}&password=${passwordField.value}&function=login`)
    .then(response => response.json())
    .then(data => {
        if (data == "null") {
            errorField.textContent = "Nieprawidlowy email lub haslo.";
        } else if (data == "yes") {
            document.location.search = "?profile";
            document.cookie = "logging";
        }
    });
});


const container = document.querySelector(".L-container");
const switchLogin = document.querySelector(".switchLogin");
const switchRegister = document.querySelector(".switchRegister");
const btnshowPass = document.querySelector(".btnshowPass");


const switchLoginForm = () => {
    if (container.children[1].classList.contains("hidden")) {
        container.children[2].classList.add("hidden");
        container.children[1].classList.remove("hidden");
        switchRegister.classList.remove("switchSelected");
        switchLogin.classList.add("switchSelected");
    }
};

const switchRegisterForm = () => {
    if (container.children[2].classList.contains("hidden")) {
        container.children[1].classList.add("hidden");
        container.children[2].classList.remove("hidden");
        switchLogin.classList.remove("switchSelected");
        switchRegister.classList.add("switchSelected");
    }
};
btnshowPass.addEventListener("mouseenter", () => {
    btnshowPass.parentElement.children[0].type = "text";
});
btnshowPass.addEventListener("mouseout", () => {
    btnshowPass.parentElement.children[0].type = "password";
});
switchLogin.addEventListener("click", () => {
    switchLoginForm();
});
switchRegister.addEventListener("click", () => {
    switchRegisterForm();
});
