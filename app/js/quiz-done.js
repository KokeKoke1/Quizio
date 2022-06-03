const quizer = document.querySelector(".quizer");
const btncheck = document.querySelector(".btncheck");
const clock = document.querySelector(".clock > div");
let seconds = 120;





function createFunction(id) {
    fetch(`app/functions/api/quizes.php?&id=${id}`)
    .then(response => response.json())
    .then(data => {
        for (let i=0;i<data.length;i++) {
            let question = JSON.parse(data[i].question);
            createQuestion(question.question, question.answear, i);
        }
    });
    btncheck.addEventListener("click", () => { checkQuiz(id); clearInterval(clockFunction); });
    clock.textContent = `02:00`;
    let clockFunction = setInterval(() => {
        minute = Math.ceil(seconds / 60) - 1;
        s = seconds-1 - minute*60;
        if (minute < 10) {
            minute = `0${minute}`;
        }
        if (s < 10) {
            s = `0${s}`;
        } 
        clock.textContent = `${minute}:${s}`;
        seconds--;
        if (seconds <= 0) {
            clock.textContent = `00:00`;
            checkQuiz(id);
            clearInterval(clockFunction);
        }
    }, 1000);
}

function coreQuiz(id) {
    createFunction(id);
}
const createQuestion = (title, answear, id) => {
    let question = document.createElement("div");
    question.classList.add("question");
    let answearDiv = document.createElement("div");
    answearDiv.classList.add("answear");
    question.innerHTML = `<div class="title">${title}</div>`;
    for (let i=0;i<answear.length;i++) {
        let input = document.createElement("input");
        let label = document.createElement("label");
        input.name = id;
        input.id = `${i}-${id}`;
        label.htmlFor = `${i}-${id}`;
        input.type = "radio";
        label.innerHTML = answear[i];
        label.appendChild(input);
        answearDiv.appendChild(label);
    }
    question.appendChild(answearDiv);
    quizer.appendChild(question);

}

const url = window.location.search;
let page_type = new URLSearchParams(url);
page_type = page_type.get('id')

coreQuiz(page_type);

function checkQuiz(id) {
    let pytania = document.querySelectorAll(".answear");
    let list = new Array();
    for (let i=0;i<pytania.length;i++) {
        let odpowiedz = pytania[i].querySelector("input:checked");
        if (odpowiedz != null) { odpowiedz = odpowiedz.id}
        list.push(odpowiedz);
        odpowiedz = null;
    }
    list = JSON.stringify({lista: list});
    fetch(`app/functions/quiz-checked.php?id=${id}&lista=${list}`)
    .then(response => response.json())
    .then(data => {
        quiz_end(data.pkt, data.max);
        let procent = data.pkt/data.max*100;
        procent = Number(Math.round(procent + 'e+1') + 'e-1');
        console.log(document.cookie.includes("logging"));
        if (document.cookie.includes("logging")) {
            fetch(`app/functions/api/account.php?function=addquiztodone&quiz=${id}&pkt=${procent}`);
        }
    })
}

function quiz_end(pkt,max) {
    procent = pkt/max*100;
    procent = Number(Math.round(procent + 'e+1') + 'e-1');
    const modal = document.querySelector(".modal");
    const pop = document.querySelector(".pop");
    modal.style.display = "block";
    let btncheck = document.querySelector(".btncheck");
    setTimeout(() => {
        btncheck.remove();
        modal.style.background = "rgba(0,0,0,0.75)";
        if (procent < 30) titleModal = "Poszło ci tragicznie :(";
        else if (procent < 50) titleModal = "Mam nadzieje ze na wiecej Cie stać :/";
        else if (procent < 50) titleModal = "Nie jest źle :D";
        else if (procent < 75) titleModal = "Jest naprawde dobrze :D"
        else if (procent < 90) titleModal = "Jest znakomicie! Gratuluje!"
        else titleModal = "Możesz startować w olimpiadzie! Gratuluje!"
        pop.innerHTML = `<h3>${titleModal}</h3>Wynik to ${pkt}/${max} ( ${procent}% )<br>Otrzymales również ${procent} punktów.<div style="margin-top: 20px;"><button class="btnback">Powrot do quizow</button></div>`;
        let btnback = document.querySelector(".btnback");
        btnback.addEventListener("click", () => {
            window.location.search = "?quiz";
        });
        pop.style.display = "block";
    }, 100);
    setTimeout(() => { pop.style.transform = "translate(-50%,-50%)"; }, 180);
    setTimeout(() => { pop.style.transform = "translate(-50%,-50%) scale(1)"; }, 200);
}
