let userID = document.cookie.split("; ").find((e) => e.startsWith("userID="))?.split("=")[1];
let fetchHandler
async function getData(){
    response = await doFetch({ 'operation': 'select' });

    console.log(response)
}

async function insertData(){
    
    response = await doFetch({ 'operation': 'insert', 'name': userID, 'bathroom': 1 });

    console.log(response)
}

async function proceedQueue(){
    response = await doFetch({ 'operation': 'proceed', 'name': userID, 'bathroom': 1});

    console.log(response)
}

async function doFetch(args = {}){
    console.log(args)
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