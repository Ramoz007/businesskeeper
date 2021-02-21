// Instantiate object
var req;
req=new XMLHttpRequest();
// Locate the API endpoint
req.open("GET", '/controllers/api/clients/read.php',true);
// Send request
req.send();

// On load get the response and display output
req.onload=function(){
    var jsonBlob=JSON.parse(req.responseText);
    // Value for HTML document
    var html = "";
    // Render Table Headings and Rows with data requested
    if(jsonBlob.data.length > 0){
        html+=`<div class="flex-row d-flex" style="border-bottom: 1px solid #C8C8C8; height: 30px">
            <div class="flex-row d-flex">
                <div style="width: 50px;"></div>
                <div style="width: 150px"><b>Name</b></div>
                <div style="width: 150px"><b>Client Code</b></div>
            </div>
            <div style="width: 200px; text-align: center;"><b>Number of linked contacts</b></div>
        </div>`;
        for(let i = 0; i < jsonBlob.data.length; i++){
            html+=`<div class="flex-row d-flex" style="height: 30px; padding: 5px 0px; border-bottom: 1px solid #f0f0f0;">
                <div class="flex-row d-flex">
                    <div style="width: 50px; padding-left: 15px;">
                        <input type="radio" onchange="loadLinkedContact(${jsonBlob.data[i].id})" name="clientViewRadios" id="clientViewRadios" value="3">
                    </div>
                    <div style="width: 150px">${jsonBlob.data[i].name}</div>
                    <div style="width: 150px">${jsonBlob.data[i].code}</div>
                </div>
                <div style="width: 200px; text-align: center;">0</div>
            </div>`;
        }
    }
    // Provide feedback to user if there's no results
    else {
        html += jsonBlob[0].message;
    }

    // Display to the browser
    document.getElementById("clientsLoadHere").innerHTML=html;
};