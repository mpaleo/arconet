<!-- Modal/Quick data -->
<div id="quick-data-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Quick data</h4>
            </div>
            <div class="modal-body">
                <form id="form-data-quick" action="/device/quick-data" method="post" class="form-inline">
                    <div class="form-group">
                        <select name="name" data-live-search="true">
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
                        <button class="btn btn-default" type="submit">View</button>
                    </div>
                </form>
                <hr>
                <!-- Data -->
                <p id="data-quick-result"></p>
            </div>
        </div>
    </div>
</div>
