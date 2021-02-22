// Handle Create Client
function createClientFunction(){
    // Get the name field
    var x = document.forms["createClientForm"]["name"].value;
    // Perform validation | Needs improvement
    if(x == ""){
        return;
    }
    // Instantiate object
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Will provide user feedback after successfull creation | Code has no effect yet
            window.location.replace("/public/clients");
        }
    };
    // Locate the API endpoint
    xhttp.open("POST", "/controllers/api/clients/create.php", true);
    // Set the headers
    xhttp.setRequestHeader("Content-type", "application/json");
    
    //serialize form data
    var url = $('form').serialize();

    //function to turn url to a json object
    function getUrlVars(url) {
        var hash;
        var myJson = {};
        var hashes = url.slice(url.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            myJson[hash[0]] = hash[1];
        }
        return JSON.stringify(myJson);
    }
    //pass serialized data to function
    var data = getUrlVars(url);
    // Send request
    xhttp.send(data);
}