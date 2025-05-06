var intervalID = setInterval(fetchQueue, 500);

let is_in_queue = false;
let is_on_top = false;
updateState();

async function fetchQueue() {
    let response = await doFetch({ "operation": "get_queue" });
    let data = document.getElementById('generalDataContainer');

    data.innerHTML = '';

    for (var i in response) {
        let row = response[i];
        data.innerHTML += `
            <div style="float: left;" id="data">
                <div id="dataContent">
                    ${row[0]}
                </div>
            </div>
        `;
    }
    updateState();
}


async function book() {
    if (!is_in_queue) {
        doFetch({ "operation": "insert" });
    } else {
        doFetch({ "operation": "exit" });
    }

    fetchQueue();
    updateState();
}

async function doFetch(args = {}) {
    let data = document.getElementById('generalDataContainer');
    var code = 200;

    response = await fetch("./api/fetchHandler.php", {
        method: "POST",
        mode: "cors",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams(args),
    }).then(response => {

        if (!response.ok) {
            code = response.status;
        }

        return response.json();
    }).then(json => {
        return json;
    });

    if (code != 200) {
        if (code == 401) {
            clearInterval(intervalID);
            document.cookie = "session=expired";
        }
        data.innerHTML = `
            <pre>${response}</pre>
        `;
        return "";
    }

    return response;
}

async function updateBtnColor() {
    var btn1 = document.getElementById('btn1');

    if (!is_in_queue) {
        btn1.innerHTML = "BOOK";
        btn1.style.backgroundColor = '#60F360';
        btn1.style.color = 'black';
    }
    else if (is_in_queue && is_on_top) {
        btn1.innerHTML = "I'M BACK";
        btn1.style.backgroundColor = '#DC143C';
        btn1.style.color = 'white';
    }
    else {
        btn1.innerHTML = "EXIT";
        btn1.style.backgroundColor = 'orange';
        btn1.style.color = 'white';
    }
}

async function updateState() {
    is_in_queue = await doFetch({ "operation": "is_in_queue" }) == "true" ? true : false;
    is_on_top = await doFetch({ "operation": "is_top" }) == "true" ? true : false;

    updateBtnColor();
}