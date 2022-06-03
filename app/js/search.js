const searched = document.querySelector(".option-search");
const btnSearch = document.querySelector(".search > button");
const inputSearch = document.querySelector(".search > input");


btnSearch.addEventListener("click", () => {
    searchUser();
})
inputSearch.addEventListener("keydown", (event) => {
    if (event.keyCode === 13) {
        searchUser();
    }
})
inputSearch.addEventListener("blur", () => {
    setTimeout(() => {
        btnSearch.style.borderBottomRightRadius = "30px";
        inputSearch.style.borderBottomLeftRadius = "30px";
        btnSearch.style.borderTopRightRadius = "30px";
        inputSearch.style.borderTopLeftRadius = "30px";
        searched.style.display = "none";
    }, 100);
})
function searchUser() {
    if (inputSearch.value.length > 1) {
        searched.innerHTML = "";
        fetch(`app/functions/api/account.php?function=searchuser&name=${inputSearch.value}`)
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                for (let i=0;i<data.length;i++) {
                    let link = document.createElement("a");
                    link.href = `?profile&p=${data[i].id}`;
                    link.innerHTML = `<li><i class="fas fa-search"></i>${data[i].name}</li>`;
                    searched.appendChild(link);
                }
                searched.style.display = "block";
                btnSearch.style.borderBottomRightRadius = "0px";
                inputSearch.style.borderBottomLeftRadius = "0px";
                btnSearch.style.borderTopRightRadius = "10px";
                inputSearch.style.borderTopLeftRadius = "10px";
            }
        })
    }
}


const listQuizes = document.querySelector(".listQuizes");
const btnlast = document.querySelector(".listQuizesGroup > button:last-child");
const btnfirst = document.querySelector(".listQuizesGroup > button:first-child");

btnlast.addEventListener("click", () => {
    listQuizes.scroll({left: listQuizes.scrollLeft+500, behavior: 'smooth'})
})
btnfirst.addEventListener("click", () => {
    listQuizes.scroll({left: listQuizes.scrollLeft-500, behavior: 'smooth'})
})
const createQuizList = (id) => {
    if (id == undefined) {
        id = null;
    }
    fetch(`app/functions/api/quizes.php?author=${id}`)
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
            for (let i=0;i<data.length;i++) {
                let div = document.createElement("div");
                div.innerHTML = `<a href="?quiz&id=${data[i].ID}&title=${data[i].title}">${data[i].title}</a>`;
                listQuizes.appendChild(div);
            }
        } else {
            let div = document.createElement("div");
            div.innerHTML = `Kurza twarz :/ Uzytkownik nie posiada zadnych stworzonych przez siebie quizow/testow.`;
            listQuizes.appendChild(div);           
        }
    })
}

let x = new URLSearchParams(url);
x = x.get('p')

createQuizList(x);