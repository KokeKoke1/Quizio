const createquiz = document.querySelector(".createquiz");
const btnCreateQuiz = document.querySelector(".btnCreateQuiz");
const btnaddQuestion = document.querySelector(".btnaddQuestion");
let $nr_block = 1;

function generateCreateQuestionTable() {
    let questionTable = document.createElement("div");
    questionTable.classList.add("questionTable");
    questionTable.dataset.id = $nr_block;
    $nr_block++;
    questionTable.innerHTML = `
        <input type="text" placeholder="Wpisz treść pytania">
    `;
    let answear = document.createElement("div");
    answear.classList.add("answear");
    questionTable.appendChild(answear);
    createquestionAnswear(answear);
    let btnanswer = document.createElement("button");
    btnanswer.textContent = "Dodaj odpowiedz";
    questionTable.appendChild(btnanswer);
    createquiz.appendChild(questionTable);

    btnanswer.addEventListener("click", () => {
        createquestionAnswear(answear);
    })
    let btn = document.createElement("button");
    btn.classList.add("remove");
    btn.innerHTML = `<i class="fas fa-trash"></i> Usun pytanie. `;
    questionTable.appendChild(btn);
    btn.addEventListener("click", () => {
        questionTable.remove();
    })

}
const createquestionAnswear = (answear) => {
    let li = document.createElement("li");
    li.innerHTML = `<input type="text" placeholder="Wpisz tresc odpowiedzi"><input type="radio" name="${answear.parentElement.dataset.id}">`;
    let btn = document.createElement("button");
    btn.classList.add("remove");
    btn.innerHTML = `<i class="fas fa-trash"></i>`;
    li.appendChild(btn);
    btn.addEventListener("click", () => {
        li.remove();
    })
    answear.appendChild(li);
}

generateCreateQuestionTable();

btnaddQuestion.addEventListener("click", () => {
    generateCreateQuestionTable();
})

btnCreateQuiz.addEventListener("click", () => {
    let title = document.querySelector("#titleQuest").value;
    let question_answear = [];
    let question = [];
    let data = [];
    let quest;
    let coretant;
    let error = 0;
    let listtquiz = createquiz.querySelectorAll(".questionTable");
    if (title.length < 4) { error++; }
    if (listtquiz.length < 3) { error++; }
    for (let i=0;i<listtquiz.length;i++) {
        question = listtquiz[i].childNodes[1].value;
        let answear = listtquiz[i].childNodes[3].querySelectorAll("li");
        for (let x=0;x<answear.length;x++) {
            if (answear[x].childNodes[0].value == "") { error++; }
            question_answear.push(answear[x].childNodes[0].value);
            if (answear[x].childNodes[1].checked) {
                coretant = x;
            }
        }
        if (coretant == null) { error++; }
        if (question == "") { error++; }
        if (question_answear.length < 2) { error++; }
        quest = {
            question: question,
            answear: question_answear,
            coretant: coretant
        };
        data.push(quest);
        question_answear = [];
        coretant = null;
    }
    if (error != 0) {
        console.log(`Nie da rady stworzyc quizu! Sa bledy! (${error})`);
    } else {
        fetch(`app/functions/api/quiz-create.php`, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                data: JSON.stringify({
                    title: title, 
                    question: data
                })
            })
        }).then((res) => {
            console.log("this is res", res)
        }).catch((err) => {
            console.log(err)
        })
        window.location.search = "?quiz";
    }
})
