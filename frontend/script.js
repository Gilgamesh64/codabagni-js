setInterval(fetchQueue, 1000);

let is_in_queue;
let is_on_top;

async function fetchQueue() {

    let response = await doFetch({ "operation": "get_queue" });
    let data = document.getElementById('generalDataContainer');

    data.innerHTML = '';

    console.log(response)
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

    let is_top = await doFetch({"operation": "is_top"});
    is_on_top = is_top;

    if(is_in_queue && !is_on_top){
        var btn1 = document.getElementById('btn1');
        btn1.innerHTML = "ESCI";
        btn1.style.backgroundColor = '#DC143C';
        btn1.style.color = 'white';
    }   
}


async function prenotare() {
    var btn1 = document.getElementById('btn1');
    if (btn1.innerHTML == "PRENOTA") {
        btn1.innerHTML = "SONO TORNATO";
        btn1.style.backgroundColor = '#DC143C';
        btn1.style.color = 'white';

        doFetch({ "operation": "insert" });
        is_in_queue = true;
        fetchQueue();

    } else {
        btn1.innerHTML = "PRENOTA";
        btn1.style.backgroundColor = '#60F360';
        btn1.style.color = 'black';

        doFetch({ "operation": "proceed" });
        fetchQueue();
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