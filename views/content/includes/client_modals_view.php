<div class="modal" id="createClientModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create a Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="create_close" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="createClientForm" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="validationCustom01">Name:</label>
                        <input type="text" name="name" class="form-control" id="validationCustom01" placeholder="Enter name" required>
                        <div class="invalid-feedback">
                            Please provide a name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="readOnlyInput">Client Code</label>
                        <input class="form-control" id="readOnlyInput" type="text" placeholder="- - - - - -" readonly="">
                        <small class="form-text text-muted">This code is automatically created...</small>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="createClient" type="submit" name="submit" value="submit" onclick="return createClientFunction()" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary create_closeBtn" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="linkContactModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Link a Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="link_close" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="availableContactsLoadHere" class="message box">
                    Please select a Client first!!!
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