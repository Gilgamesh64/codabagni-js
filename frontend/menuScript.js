fetchBathrooms()

function fetchBathrooms(){
    fetch("./api/fetchHandler.php",
        { 
            method: "POST",
            mode: "cors",
            headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({"operation": "get_bathrooms"}),
        }
    )
    .then(response => {
        return response.json();
    })
    .then(json => {
        let form = document.getElementById("form");
        
        for (var i in json) {
            let row = json[i];
            form.innerHTML += 
            `
            <button type="submit" name="submit" value="in${row}">Bagno ${row}</button>
            `;
        }
    });
}