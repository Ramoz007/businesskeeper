<div class="modal" id="createContactModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create a Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="create_close" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="createContactForm" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="validationCustom01">Name:</label>
                        <input type="text" name="name" class="form-control" id="validationCustom01" aria-describedby="emailHelp" placeholder="Enter name" required>
                        <div class="invalid-feedback">
                            Please provide a name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom02">Surname:</label>
                        <input type="text" name="surname" class="form-control" id="validationCustom02" aria-describedby="emailHelp" placeholder="Enter surname" required>
                        <div class="invalid-feedback">
                            Please provide a surname.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="validationCustom03">Email:</label>
                        <input type="email" name="email" class="form-control" id="validationCustom03" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="createContact" type="submit" name="submit" value="submit" onclick="return createContactFunction()" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary create_closeBtn" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="linkClientModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Link a Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="link_close" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="availableClientsLoadHere" class="message box">
                    Please select a Contact first!!!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Link</button>
                <button type="button" class="btn btn-secondary link_closeBtn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Handle Javascript UI validation errors and success -->
<script type="text/javascript" src="js/clients/createFormClient.js"></script>