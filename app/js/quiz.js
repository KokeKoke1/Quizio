const container = document.querySelector(".items-quiz");
const alphabet = document.querySelector("input[value=alphabet]");
const date = document.querySelector("input[value=date]");
const previousPage = document.querySelector("#previous_page");
const nextPage = document.querySelector("#next_page");
const numberPage = document.querySelector("#number_page");
const addquiz = document.querySelector(".addquiz");

if (document.cookie.includes("logging")) {
    addquiz.innerHTML = `<button class="quizcreate">Chcesz posiadac wlasny quiz? Poprostu go stworz! Kliknij aby stworzyc quiz.</button>`;
    const quizcreate = document.querySelector(".quizcreate");
    quizcreate.addEventListener("click", ()=>{
        window.location.search = "?create-quiz";
    })
}

let $page = 1;
let $howPage;

alphabet.addEventListener("change", () => {
    coreQuiz($page);    
})
date.addEventListener("change", () => {
    coreQuiz($page);    
})
previousPage.addEventListener("click", () => {
    if ($page > 1) {
        $page--;
        coreQuiz($page);
    }
})

nextPage.addEventListener("click", () => {
    if ($page < $howPage) {
        $page++;
        coreQuiz($page);
    }
})

const createQuizArticle = (id, title, name, id_user) => {
    let li = document.createElement("li");
    let link = document.createElement("a");
    li.appendChild(link);
    li.style.display = "flex";
    li.style.justifyContent = "start";
    container.appendChild(li);
    setTimeout(() => {
        if (title != null) {
            li.innerHTML = `<div class="md-1"><a href="?quiz&id=${id}&title=${title}">${title}</a></div>
            <div class="md-4" style="text-align: right;"><a href="?profile&p=${id_user}">${name}</a></div>`;
        }
    }, 400);
}


const coreQuiz = (page) => {
    container.innerHTML = `<div class="title" style="font-size: 1.6rem;">Dostepne quizy: </div>`;
    numberPage.textContent = $page;
    let sort = 0;
    if (alphabet.checked == true) sort = 1;
    fetch(`app/functions/api/quizes.php?page=${page}&sort=${sort}`)
    .then(response => response.json())
    .then(data => {
        $howPage = Math.ceil(data[15]/15);
        for (let i=0;i<data.length-1;i++) {
            createQuizArticle(data[i].ID, data[i].title, data[i].name, data[i].ID_AUTHOR);
        }
    });
}

coreQuiz(1);
