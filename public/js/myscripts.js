// Not used
function changeTabbed(evt, tabName) {
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
        document.getElementById("client_link").style.display = "block";
    }else {
        document.getElementById("client_link").style.display = "none";
    }
    if(tabName === "Contacts"){
        document.getElementById("contact_link").style.display = "block";
    }else {
        document.getElementById("contact_link").style.display = "none";
    }
}
// Set the default tab on load
document.getElementById("defaultOpen").click();