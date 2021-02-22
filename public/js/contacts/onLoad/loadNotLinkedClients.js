// Load all the Clients available to be linked to Contact
function loadNotLinkedClient(contact_id) {
    // Instantiate object
    var reqLinks;
    reqLinks = new XMLHttpRequest();

    // Locate the API endpoint
    reqLinks.open("GET", '/controllers/api/contacts/read_not_clients.php?contact_id='+contact_id, true);
    // Send request
    reqLinks.send();

    // On load get the response and display output
    reqLinks.onload = function () {
        var jsonBlob = JSON.parse(reqLinks.responseText);
        // Value for HTML document
        var html = "";
        // Render Table Headings and Rows with data requested
        if (jsonBlob.data.length > 0) {
            html += `<div class="flex-row d-flex" style="border-bottom: 1px solid #C8C8C8; height: 30px">
                <div class="flex-row d-flex">
                    <div style="width: 50px;"></div>
                    <div style="width: 150px"><b>Name</b></div>
                    <div style="width: 150px"><b>Client Code</b></div>
                </div>
            </div>`;
            for (let i = 0; i < jsonBlob.data.length; i++) {
                html += `<div class="flex-row d-flex" style="height: 30px; padding: 5px 0px; border-bottom: 1px solid #f0f0f0;">
                    <div class="flex-row d-flex">
                        <div style="width: 50px; padding-left: 15px;">
                            <input type="radio" name="clientLinkRadios" id="clientLinkRadios">
                        </div>
                        <div style="width: 150px">${jsonBlob.data[i].name}</div>
                        <div style="width: 150px">${jsonBlob.data[i].code}</div>
                    </div>
                </div>`;
            }
        }
        // Provide feedback to user if there's no results 
        else {
            html += jsonBlob[0].message;
        }

        // Display to the browser
        document.getElementById("availableClientsLoadHere").innerHTML = html;
    };
}