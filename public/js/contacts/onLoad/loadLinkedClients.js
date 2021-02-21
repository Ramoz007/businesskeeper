function loadLinkedClient(id) {
    //loadNotLinkedClient(id);
    var reqLinks;
    reqLinks = new XMLHttpRequest();
    reqLinks.open("GET", '/controllers/api/contacts/read_clients.php?id=' +id, true);
    reqLinks.send();
    reqLinks.onload = function () {
        var jsonBlob = JSON.parse(reqLinks.responseText);
        var html = "";
        if (jsonBlob.data.length > 0) {
            html += `<div class="flex-row d-flex" style="border-bottom: 1px solid #C8C8C8; height: 30px">
                <div class="flex-row d-flex">
                    <div style="width: 150px"><b>Name</b></div>
                    <div style="width: 150px"><b>Client Code</b></div>
                </div>
            </div>`;
            for (let i = 0; i < jsonBlob.data.length; i++) {
                html += `<div class="flex-row d-flex" style="height: 30px; padding: 5px 0px; border-bottom: 1px solid #f0f0f0;">
                    <div class="flex-row d-flex">
                        <div style="width: 150px">${jsonBlob.data[i].name}</div>
                        <div style="width: 150px">${jsonBlob.data[i].code}</div>
                        <div style="width: 200px; text-align: center;"><a href="#">UNLINK Client</a></div>
                    </div>
                </div>`;
            }
        }
        else {
            html += jsonBlob[0].message;
        }

        //append in message class
        document.getElementById("contactClientsLoadHere").innerHTML = html;
    };
}