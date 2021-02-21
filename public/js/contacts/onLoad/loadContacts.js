var req;
req=new XMLHttpRequest();
req.open("GET", '/controllers/api/contacts/read.php',true);
req.send();
req.onload=function(){
    var jsonBlob=JSON.parse(req.responseText);
    var html = "";
    if(jsonBlob.data.length > 0){
        html+=`<div class="flex-row d-flex" style="border-bottom: 1px solid #C8C8C8; height: 30px">
            <div class="flex-row d-flex">
                <div style="width: 50px;"></div>
                <div style="width: 150px"><b>Name</b></div>
                <div style="width: 150px"><b>Surname</b></div>
                <div style="width: 150px"><b>Email</b></div>
            </div>
            <div style="width: 200px; text-align: center;"><b>Number of linked clients</b></div>
        </div>`;
        for(let i = 0; i < jsonBlob.data.length; i++){
            html+=`<div class="flex-row d-flex" style="height: 30px; padding: 5px 0px; border-bottom: 1px solid #f0f0f0;">
                <div class="flex-row d-flex">
                    <div style="width: 50px; padding-left: 15px;">
                        <input type="radio" onchange="loadLinkedClient(${jsonBlob.data[i].id})" name="contactViewRadios" id="contactViewRadios1" value="option1">
                    </div>
                    <div style="width: 150px">${jsonBlob.data[i].name}</div>
                    <div style="width: 150px">${jsonBlob.data[i].surname}</div>
                    <div style="width: 150px">${jsonBlob.data[i].email}</div>
                </div>
                <div style="width: 200px; text-align: center;">1</div>
            </div>`;
        }
    }
    else {
        html += jsonBlob[0].message;
    }

    //append in message class
    document.getElementById("contactsLoadHere").innerHTML=html;
};