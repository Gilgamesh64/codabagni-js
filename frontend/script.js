function fetchQueue() {
    fetch("./api/fetchHandler.php",
        {
            method: "POST",
            mode: "cors",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({ "operation": "get_queue"}),
        }
    )
        .then(response => {
            return response.json();
        })
        .then(json => {
            let data = document.getElementById('generalDataContainer');
            data.innerHTML = '';
            console.log(json)
            for (var i in json) {
                let row = json[i];
                data.innerHTML +=
                    `
                <div id="data">
                <div id="dataContent">
                        ${row[0]}
                </div>
                </div>
                `;
            }
        });
}


function prenotare() {
    var btn1 = document.getElementById('btn1');
    if (btn1.innerHTML == "PRENOTA") {
        btn1.innerHTML = "SONO TORNATO";
        btn1.style.backgroundColor = '#DC143C';
        btn1.style.color = 'white';
    } else {
        btn1.innerHTML = "PRENOTA";
        btn1.style.backgroundColor = '#60F360';
        btn1.style.color = 'black';
    }


}