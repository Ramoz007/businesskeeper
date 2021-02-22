// Handle Create Client
function linkContactFunction(){
    // Instantiate object
    var reqqLink;
    reqqLink=new XMLHttpRequest();

    // Get current client_id from sessionStorage if supported
    let $client_id;
    let $contact_id;
    if (typeof (Storage) !== "undefined") {
        // Retrieve
        $client_id = sessionStorage.getItem("current_client_id");
        $contact_id = sessionStorage.getItem("clientAddContact");
    }

    // Locate the API endpoint
    reqqLink.open("GET", "/controllers/api/clients/link_contacts.php?client_id="+$client_id+"&contact_id="+$contact_id,true);
    // Send request
    reqqLink.send();

    reqqLink.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Will provide user feedback after successfull creation | Code has no effect yet
            window.location.replace("/public/clients");
        }
    };
}