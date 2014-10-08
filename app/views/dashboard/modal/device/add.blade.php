<!-- Modal/Add device -->
<div id="add-device-modal" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add device</h4>
            </div>
            <div class="modal-body">
                <form id="form-device-add" action="/device/add" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" type="text" placeholder="Device name" name="name" autocomplete="off">
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success btn-block btn-sm" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="add-device-alert-success" class="alert alert-success">
                    <strong>Well done!</strong> You successfully created a new device. <a href="/" class="alert-link">Refresh to see changes</a>
                </div>
                <div id="add-device-alert-info" class="alert alert-info">
                    <strong>Heads up!</strong> Already exists a device with that name
                </div>
                <div id="add-device-alert-error" class="alert alert-danger">
                    <strong>Woops!</strong> Some internal error has ocurred
                </div>
            </div>
        </div>
    </div>
</div>
