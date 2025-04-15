fetchBathrooms()

function fetchBathrooms() {
    fetch("./api/fetchHandler.php", {
        method: "POST",
        mode: "cors",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({ "operation": "get_bathrooms" }),
    }).then(response => {
        return response.json();
    }).then(json => {
        let form = document.getElementById("contenitoreBagni");

        if (json == "Session expired") {
            document.cookie = "session=expired";
            form.innerHTML = `
                <pre>Session expired, please logout or refresh the page.</pre>
            `;
            return;
        }

        for (var i in json) {
            let row = json[i];
            form.innerHTML += `
                <button type="submit" name="submit" value="in${row}">Bagno ${row}</button>
            `;
        }
    });
}