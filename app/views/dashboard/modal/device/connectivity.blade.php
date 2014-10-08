<!-- Modal/Connectivity -->
<div id="connectivity-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Device connectivity</h4>
            </div>
            <div class="modal-body">
                <form id="form-device-connectivity" action="/device/connectivity" method="post">
                    <div class="form-group">
                        <select name="name" data-live-search="true" data-width="100%">
                            @if($devices->isEmpty())
                                <option value="default-value" selected="selected">Without devices</option>
                            @else
                                @foreach($devices as $device)
                                    <option value="{{ $device->name }}">{{ $device->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">http://</span>
                            <input name="ip" type="text" class="form-control" placeholder="IP" autocomplete="off">
                            <span class="input-group-addon">:</span>
                            <input name="port" type="text" class="form-control" placeholder="Port" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm btn-block">Apply</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div id="conectivity-device-alert-success" class="alert alert-success">
                    <strong>Well done!</strong> You successfully updated the device
                </div>
                <div id="conectivity-device-alert-info" class="alert alert-info">
                    <strong>Heads up!</strong> Doesn't exists a device with that name
                </div>
                <div id="conectivity-device-alert-error" class="alert alert-danger">
                    <strong>Woops!</strong> Some internal error has ocurred
                </div>
            </div>
        </div>
    </div>
</div>
