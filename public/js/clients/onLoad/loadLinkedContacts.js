// Load all the Client's Contacts
// Receives with selected client ID
function loadLinkedContact(client_id){
    loadNotLinkedContact(client_id);

    // Instantiate object
    var reqLink;
    reqLink=new XMLHttpRequest();

    // Locate the API endpoint
    reqLink.open("GET", '/controllers/api/clients/read_contacts.php?client_id='+client_id,true);
    // Send request
    reqLink.send();

    // On load get the response and display output
    reqLink.onload=function(){
        var jsonBlob=JSON.parse(reqLink.responseText);
        // Value for HTML document
        var html = "";
        // Render Table Headings and Rows with data requested
        if(jsonBlob.data.length > 0){
            html+=`<div class="flex-row d-flex" style="border-bottom: 1px solid #C8C8C8; height: 30px">
            <div class="flex-row d-flex">
                <div style="width: 150px"><b>Full Name</b></div>
                <div style="width: 150px"><b>Email</b></div>
            </div>
        </div>`;
            for(let i = 0; i < jsonBlob.data.length; i++){
                html+=`<div class="flex-row d-flex" style="height: 30px; padding: 5px 0px; border-bottom: 1px solid #f0f0f0;">
                <div class="flex-row d-flex">
                    <div style="width: 150px">${jsonBlob.data[i].name} ${jsonBlob.data[i].surname}</div>
                    <div style="width: 150px">${jsonBlob.data[i].email}</div>
                    <div style="width: 200px; text-align: center;"><a onclick="unlinkContactFunction(${client_id},${jsonBlob.data[i].contact_id})" href="#">UNLINK Contact</a></div>
                </div>
            </div>`;
            }
        }
        // Provide feedback to user if there's no results
        else {
            html += jsonBlob[0].message;
        }

        // Display to the browser
        document.getElementById("clientContactsLoadHere").innerHTML=html;
    };
}

function unlinkContactFunction(client_id, contact_id){

    // Instantiate object
    var xxhttp = new XMLHttpRequest();
    // Locate the API endpoint
    xxhttp.open("GET", "/controllers/api/clients/unlink_contacts.php?client_id="+client_id+"&contact_id="+contact_id, true);
    xxhttp.send();
    window.location.replace("/public/clients");
}