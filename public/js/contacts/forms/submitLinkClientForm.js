// Handle Create Client
function linkClientFunction(){
    // Instantiate object
    var reqxqLink;
    reqxqLink=new XMLHttpRequest();

    // Get current client_id from sessionStorage if supported
    let $client_id;
    let $contact_id;
    if (typeof (Storage) !== "undefined") {
        // Retrieve
        $client_id = sessionStorage.getItem("current_contact_id");
        $contact_id = sessionStorage.getItem("contactAddClient");
    }

    // Locate the API endpoint
    reqxqLink.open("GET", "/controllers/api/contacts/link_clients.php?client_id="+$client_id+"&contact_id="+$contact_id,true);
    // Send request
    reqxqLink.send();

    reqxqLink.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Will provide user feedback after successfull creation | Code has no effect yet
            window.location.replace("/public/contacts");
        }
    };
}