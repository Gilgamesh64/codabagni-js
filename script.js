async function fetchData(){
    response = await fetch("./db.php")
    .then(response => {
        return response.json();
    })
    .then(json => {
        return json;
    });

    let data = document.getElementById("data");
                
    data.innerHTML = "";

    for (let index = 0; index < response.length; index++) {
        const element = response[index];
        
    }
}