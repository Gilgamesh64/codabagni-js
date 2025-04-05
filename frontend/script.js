
function fetchData() {
    fetch("./api/fetchHandler.php")
        .then(response => {
            return response.json();
        })
        .then(json => {
            let data = document.getElementById('generalDataContainer');

            data.innerHTML = '';

            for (var i in json) {
                let row = json[i];
                data.innerHTML +=
                    `
                <div id="data">
                <div id="dataContent">
                        ${row['Name']}
                </div>
                </div>
                `;
            }

        })
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