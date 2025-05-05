fetchBathrooms()

async function fetchBathrooms() {
    let form = document.getElementById("contenitoreBagni");
    var code = 200;

    response = await fetch("./api/fetchHandler.php", {
        method: "POST",
        mode: "cors",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({ "operation": "get_bathrooms" }),
    }).then(response => {

        if (!response.ok) {
            code = response.status;
        }

        return response.json();
    }).then(json => {
        return json;
    });

    if (code != 200) {
        document.cookie = "session=expired";
        form.innerHTML = `
            <pre>${response}</pre>
        `;
        return;
    }

    /*
    if (response == "Session expired") {
        document.cookie = "session=expired";
        form.innerHTML = `
            <pre>Session expired, please logout or refresh the page.</pre>
        `;
        return;
    }
    */

    for (var i in response) {
        let row = response[i];
        document.getElementById("contenitoreBagni").innerHTML += `
            <button type="submit" name="submit" value="in${row}">Bagno ${row}</button>
        `;
    }
}
