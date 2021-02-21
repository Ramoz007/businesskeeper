// Load all the Client's Contacts
function loadLinkedContact(id){
    //loadNotLinkedContact(id); | TODO: function needs proper call

    // Instantiate object
    var reqLink;
    reqLink=new XMLHttpRequest();

    // Locate the API endpoint
    reqLink.open("GET", '/controllers/api/clients/read_contacts.php?id='+id,true);
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
                    <div style="width: 200px; text-align: center;"><a href="#">UNLINK Contact</a></div>
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