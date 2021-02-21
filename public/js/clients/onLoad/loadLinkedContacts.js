function loadLinkedContact(id){
    //loadNotLinkedContact(id);
    var reqLink;
    reqLink=new XMLHttpRequest();
    reqLink.open("GET", '/controllers/api/clients/read_contacts.php?id='+id,true);
    reqLink.send();
    reqLink.onload=function(){
        var jsonBlob=JSON.parse(reqLink.responseText);
        var html = "";
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
        else {
            html += jsonBlob[0].message;
        }

        //append in message class
        document.getElementById("clientContactsLoadHere").innerHTML=html;
    };
}