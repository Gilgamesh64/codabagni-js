fetchBathrooms()

async function fetchBathrooms() {
    let form = document.getElementById("bathroomsContainer");
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
        if (code == 401) {
            document.cookie = "session=expired";
        }
        form.innerHTML = `
            <pre>${response}</pre>
        `;
        return;
    }

    response.forEach(row => {
        document.getElementById("bathroomsContainer").innerHTML += `
            <button type="submit" name="submit" value="in${row}">Bath ${row}</button>
        `;
    });
}
