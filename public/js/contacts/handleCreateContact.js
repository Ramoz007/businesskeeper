// Get the modal
var createModal = document.getElementById("createContactModal");

// Get the button that opens the modal
var createBtn = document.getElementById("createContactBtn");

// Get the <span> element that closes the modal
var createSpan = document.getElementsByClassName("create_close")[0];
var createCloseBtn = document.getElementsByClassName("create_closeBtn")[0];

// When the user clicks the button, open the modal
createBtn.onclick = function() {
    createModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
createSpan.onclick = function() {
    createModal.style.display = "none";
}
createCloseBtn.onclick = function (){
    createModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == createModal) {
        createModal.style.display = "none";
    }
}