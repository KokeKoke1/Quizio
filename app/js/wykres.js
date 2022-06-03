


const url = window.location.search;
let page_type = new URLSearchParams(url);
page_type = page_type.get('p');
if (page_type == null) page_type = "";
fetch(`app/functions/api/account.php?function=getscorewy&id=${page_type}`)
.then(response => response.json())
.then(x => {
    let datas = []; let labels = [];
    for (let i=0;i<x.length-1;i++) labels.push(`Quiz: ${x[i].title}`);
    for (let i=0;i<x.length;i++) datas.push(x[i].PROCENT); 
    let myChart = new Chart(document.getElementById('chart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Wynik quizu.',
                backgroundColor: '#34c0eb',
                borderColor: '#34c0eb',
                borderWidth: 4,
                data: datas,
            }]
        },
        options: {
            plugins: {
                legend: {
                   display: false
                }
            }
        }
    }
);
});

