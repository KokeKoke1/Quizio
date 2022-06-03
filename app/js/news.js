const container = document.querySelector(".items-news");

const createNewsArticle = (xtitle, xautor, xdate, xarticle) => {
    let row = document.createElement("div")
    row.classList.add("row");
    let articletext = document.createElement("div")
    articletext.classList.add("items");
    articletext.classList.add("md-2");
    let news = document.createElement("div")
    news.classList.add("news");

    let title = document.createElement("div");
    title.classList.add("title");
    let autor = document.createElement("span");
    autor.classList.add("autor");
    let date = document.createElement("span");
    date.classList.add("date");
    let article = document.createElement("div");
    article.classList.add("article");

    let articleimg = document.createElement("div")
    articleimg.classList.add("items");
    articleimg.classList.add("md-2");
    articleimg.classList.add("items-img");
    
    news.appendChild(title);
    news.appendChild(autor);
    news.appendChild(date);
    news.appendChild(article);
    articletext.appendChild(news);
    row.appendChild(articletext);
    row.appendChild(articleimg);
    container.appendChild(row);
    setTimeout(() => {
        if (xtitle != null) {
            title.textContent = xtitle;
            autor.innerHTML = `<i class="fas fa-user-tie"></i> ${xautor}`;
            date.innerHTML = `<i class="fas fa-table"></i> ${xdate}`;
            articleimg.innerHTML = '<img src="https://ocdn.eu/pulscms-transforms/1/rJOk9kpTURBXy9jMTFkNjlkMTUzMTFjODA0ZTgxOGIyOGEzYTNhNWZiNi5qcGeTlQMAzQICzR6TzRE0kwXNAxTNAbyTCaZkODZlZjIGgaEwAQ/jak-dobrze-znasz-gory-swiata.jpg">';
            article.textContent = xarticle;
        }
    }, 500);
}

const coreNews = () => { 
    fetch('app/functions/api/news.php')
    .then(response => response.json())
    .then(data => {
        for (let i=0;i<data.length;i++) {
            createNewsArticle(data[i].title, data[i].autor, data[i].date, data[i].text);
        }
    });
}

coreNews();