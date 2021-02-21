var req;
req=new XMLHttpRequest();
req.open("GET", '/controllers/api/clients/read.php',true);
req.send();
req.onload=function(){
    var jsonBlob=JSON.parse(req.responseText);
    var html = "";
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
    else {
        html += jsonBlob[0].message;
    }

    //append in message class
    document.getElementById("clientsLoadHere").innerHTML=html;
};