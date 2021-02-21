// Handle Create Contact
function createContactFunction(){
    // Get the name, surname and email fields
    var x = document.forms["createContactForm"]["name"].value;
    var y = document.forms["createContactForm"]["surname"].value;
    var z = document.forms["createContactForm"]["email"].value;
    // Perform validation | Needs improvement
    if(x == "" || y == "" || z == ""){
        return;
    }
    // Instantiate object
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Will provide user feedback after successfull creation | Code has no effect yet
            document.getElementById("demo").innerHTML = this.responseText;
        }
    };
    // Locate the API endpoint
    xhttp.open("POST", "/controllers/api/contacts/create.php", true);
    // Set the headers
    xhttp.setRequestHeader("Content-type", "application/json");
    
    //serialize form data
    var url = $('form').serialize();

    //function to turn url to an object
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