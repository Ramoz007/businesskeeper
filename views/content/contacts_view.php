<div class="flex-row d-flex justify-content-between" style="border-bottom: 1px solid #C8C8C8; padding: 5px; height: 50px;">
    <div class="d-flex"><h3>Contacts</h3></div>
    <div class="d-flex"><button type="button" id="createContactBtn" class="btn btn-primary" style="border-radius: 15px">+ Create Contact</button></div>
</div>
<div style="height: 50px">
    <div class="flex-row d-flex justify-content-between" style="border-bottom: 1px solid #C8C8C8;">
        <div class="tab align-items-center">
            <button class="tablinks" id="defaultOpen" style="height: 50px" onclick="changeTabs(event, 'General')">General</button>
            <button class="tablinks" id="linkable" style="height: 50px" onclick="changeTabs(event, 'Clients')">Clients</button>
        </div>
        <div style="padding: 5px; padding-top: 7px">
            <button type="button" id="linkClientBtn" class="btn btn-success" style="border-radius: 15px">+ Link Client</button>
        </div>
    </div>
    <div id="General" class="tabcontent">
        <p id="contactsLoadHere" class="message box"></p>
    </div>
    <div id="Clients" class="tabcontent">
        <p id="contactClientsLoadHere">Please select a Contact first!!!</p>
    </div>
</div>

<?php include 'includes/contact_modals_view.php'; ?>

<script type="text/javascript" src="js/contacts/handleCreateContact.js"></script>
<script type="text/javascript" src="js/contacts/handleLinkToClient.js"></script>
<script type="text/javascript" src="js/contacts/onLoad/loadContacts.js"></script>
<script type="text/javascript" src="js/contacts/onLoad/loadLinkedClients.js"></script>
<script type="text/javascript" src="js/contacts/forms/submitCreateForm.js"></script>
<script>
    function changeTabs(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";

        if(tabName === "Clients"){
            document.getElementById("linkClientBtn").style.display = "block";
        }else {
            document.getElementById("linkClientBtn").style.display = "none";
        }
    }
    document.getElementById("defaultOpen").click();
</script>