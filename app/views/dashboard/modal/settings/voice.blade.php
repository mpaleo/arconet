<!-- Settings/Voice -->
<div id="voice-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Voice settings</h4>
            </div>
            <div class="modal-body">


                <!-- Enable voice -->
                <h4>Enable/Disable <small>(Voice recognition & speech synthesis)</small><input type="checkbox" id="enable-voice"></h4><hr>


                <!-- Add new voice command -->
                <h4>Add new command</h4>
                <form id="form-voice-command-add" action="/settings/voice-command/add" method="post">

                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Command name" name="name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Voice order" name="order" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <div id="command-action-editor" style="height: 100px;font-size: 16px;"></div>
                        <textarea id="command-action-editor-textarea" name="action" style="display:none;"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block btn-sm" type="submit">Add</button>
                    </div>

                </form>
                <!-- Alerts -->
                <div id="settings-voice-add-alert-success" class="alert alert-success">
                    <strong>Well done!</strong> You successfully created a command
                </div>
                <div id="settings-voice-add-alert-info" class="alert alert-info">
                    <strong>Heads up!</strong> Already exists a command with that name
                </div>
                <div id="settings-voice-add-alert-error" class="alert alert-danger">
                    <strong>Woops!</strong> Some internal error has ocurred
                </div><hr>


                <!-- List of commands -->
                <h4>List of commands</h4>
                <table id="voice-commands-table" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table><hr>


                <!-- Delete a command -->
                <h4>Delete a command</h4>
                <form id="form-voice-command-delete" action="/settings/voice-command/delete" method="post">
                    <p>
                        Select a command from the table and click Delete
                    </p>
                    <div class="form-group">
                        <input type="hidden" id="input-delete-device" name="name">
                        <button class="btn btn-danger btn-block btn-sm" type="submit">Delete</button>
                    </div>
                </form>
                <!-- Alerts -->
                <div id="settings-voice-delete-alert-success" class="alert alert-success">
                    <strong>Well done!</strong> You successfully deleted the command. <a href="/" class="alert-link">Refresh to see changes</a>
                </div>
                <div id="settings-voice-delete-alert-info" class="alert alert-info">
                    <strong>Heads up!</strong> Doesn't exists a command with that name
                </div>
                <div id="settings-voice-delete-alert-error" class="alert alert-danger">
                    <strong>Woops!</strong> Some internal error has ocurred
                </div>

            </div>
        </div>
    </div>
</div>
