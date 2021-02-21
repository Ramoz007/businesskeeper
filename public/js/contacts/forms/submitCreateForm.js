// Handle POST
function createContactFunction(){
    var x = document.forms["createContactForm"]["name"].value;
    var y = document.forms["createContactForm"]["surname"].value;
    var z = document.forms["createContactForm"]["email"].value;
    if(x == "" || y == "" || z == ""){
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "/controllers/api/contacts/create.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            var json = JSON.parse(xhttp.responseText);
        }
    };
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
    xhttp.send(data);
}