async function getData(){
    response = await fetch("./fetchHandler.php",
        { 
            method: "POST",
            mode: "cors",
            headers: {
            "Content-Type": "application/json"
            },
            body: JSON.stringify({ 'operation': 'select' })
        }
    )
    .then(response => {
        return response.json();
    })
    .then(json => {
        return json;
    });

    console.log(response)
}

async function insertData(){
    response = await fetch("./fetchHandler.php",
        { 
            method: "POST",
            mode: "cors",
            headers: {
            "Content-Type": "application/json"
            },
            body: JSON.stringify({ 'operation': 'insert', 'name': getCookie('userID'), 'bathroom': 1 })
        }
    )
    .then(response => {
        return response.json();
    })
    .then(json => {
        return json;
    });

    console.log(response)
}

async function proceedQueue(){
    response = await fetch("./fetchHandler.php",
        { 
            method: "POST",
            mode: "cors",
            headers: {
            "Content-Type": "application/json"
            },
            body: JSON.stringify({ 'operation': 'proceed' })
        }
    )
    .then(response => {
        return response.json();
    })
    .then(json => {
        return json;
    });

    console.log(response)
}



function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  