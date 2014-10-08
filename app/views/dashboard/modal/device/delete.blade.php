<!-- Modal/Delete device -->
<div id="delete-device-modal" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete device</h4>
            </div>
            <div class="modal-body">
                <form id="form-device-delete" action="/device/delete" method="post" class="form-inline">
                    <div class="row">
                        <div class="col-md-12">
                            <select name="name" data-live-search="true" data-width="100%" required>
                                @if($devices->isEmpty())
                                    <option value="default-value" selected="selected">Without devices</option>
                                @else
                                    @foreach($devices as $device)
                                        <option value="{{ $device->name }}">{{ $device->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-danger btn-block btn-sm" type="submit">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="delete-device-alert-success" class="alert alert-success">
                    <strong>Well done!</strong> You successfully deleted the device. <a href="/" class="alert-link">Refresh to see changes</a>
                </div>
                <div id="delete-device-alert-info" class="alert alert-info">
                    <strong>Heads up!</strong> Doesn't exists a device with that name
                </div>
                <div id="delete-device-alert-error" class="alert alert-danger">
                    <strong>Woops!</strong> Some internal error has ocurred
                </div>
            </div>
        </div>
    </div>
</div>
