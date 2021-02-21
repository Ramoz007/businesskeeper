<div class="flex-row d-flex justify-content-between" style="border-bottom: 1px solid #C8C8C8; padding: 5px; height: 50px;">
    <div class="d-flex"><h3>Clients</h3></div>
    <div class="d-flex">
        <button type="button" id="createClientBtn" class="btn btn-primary" style="border-radius: 15px">+ Create Client</button>
    </div>
</div>
<div style="height: 50px">
    <div class="flex-row d-flex justify-content-between" style="border-bottom: 1px solid #C8C8C8;">
        <div class="tab align-items-center">
            <button class="tablinks" id="defaultOpen" style="height: 50px" onclick="changeTabs(event, 'General')">General</button>
            <button class="tablinks" id="linkable" style="height: 50px" onclick="changeTabs(event, 'Contacts')">Contacts</button>
        </div>
        <div style="padding: 5px; padding-top: 7px">
            <button type="button" id="linkContactBtn" class="btn btn-success" style="border-radius: 15px">+ Link Contact</button>
        </div>
    </div>

    <div id="General" class="tabcontent">
        <p id="clientsLoadHere" class="message box"></p>
    </div>

    <div id="Contacts" class="tabcontent">
        <p id="clientContactsLoadHere">Please select a Client first!!!</p>
    </div>
</div>

<?php include 'includes/client_modals_view.php'; ?>

<script type="text/javascript" src="js/clients/handleCreateClient.js"></script>
<script type="text/javascript" src="js/clients/handleLinkToContact.js"></script>
<script type="text/javascript" src="js/clients/onLoad/loadClients.js"></script>
<script type="text/javascript" src="js/clients/onLoad/loadLinkedContacts.js"></script>
<script type="text/javascript" src="js/clients/forms/submitCreateForm.js"></script>
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

        if(tabName === "Contacts"){
            document.getElementById("linkContactBtn").style.display = "block";
            loadClientContactView();
        }else {
            document.getElementById("linkContactBtn").style.display = "none";
        }
    }
    document.getElementById("defaultOpen").click();
</script>