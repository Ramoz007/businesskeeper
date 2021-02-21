// Get the modal
var linkModal = document.getElementById("linkClientModal");

// Get the button that opens the modal
var linkBtn = document.getElementById("linkClientBtn");

// Get the <span> element that closes the modal
var linkSpan = document.getElementsByClassName("link_close")[0];
var linkCloseBtn = document.getElementsByClassName("link_closeBtn")[0];

// When the user clicks the button, open the modal
linkBtn.onclick = function() {
    linkModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
linkSpan.onclick = function() {
    linkModal.style.display = "none";
}
linkCloseBtn.onclick = function (){
    linkModal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == linkModal) {
        linkModal.style.display = "none";
    }
}