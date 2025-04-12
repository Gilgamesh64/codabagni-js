setInterval(fetchQueue, 1000);

let is_in_queue = false;
let is_on_top = false;

async function fetchQueue() {

    let response = await doFetch({ "operation": "get_queue" });
    let data = document.getElementById('generalDataContainer');

    data.innerHTML = '';

    for (var i in response) {
        let row = response[i];
        data.innerHTML +=
            `
                <div id="data">
                <div id="dataContent">
                        ${row[0]}
                </div>
                </div>
                `;
    }
    is_on_top = await doFetch({"operation": "is_top"});
    console.log(is_on_top)
}


async function prenotare() {
    if (!is_in_queue) {
        doFetch({ "operation": "insert" });
        is_in_queue = true;
        fetchQueue(); //updates is_on_top
        updateBtnColor();

    } else {
        doFetch({ "operation": "exit" });
        is_in_queue = false;
        is_on_top = false;
        fetchQueue(); //updates is_on_top
        updateBtnColor();
    }
}

async function doFetch(args = {}) {
    response = await fetch("./api/fetchHandler.php",
        {
            method: "POST",
            mode: "cors",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams(args),
        }
    )
        .then(response => {
            return response.json();
        })
        .then(json => {
            return json;
        });
    return response;
}

function updateBtnColor(){
    var btn1 = document.getElementById('btn1');
    if(!is_in_queue){
        btn1.innerHTML = "PRENOTA";
        btn1.style.backgroundColor = '#60F360';
        btn1.style.color = 'black';
    }
    else if(is_in_queue && is_on_top){
        btn1.innerHTML = "SONO TORNATO";
        btn1.style.backgroundColor = '#DC143C';
        btn1.style.color = 'white';
    }
    else{
        btn1.innerHTML = "ESCI";
        btn1.style.backgroundColor = '#DC143C';
        btn1.style.color = 'white';
    }
}