@if($devices->isEmpty())
    <!-- Quickstart -->
    <div class="col-lg-12">
        <h2 class="text-right lead">Getting started</h2>
        <hr>
    </div>
    <div class="col-md-4">
        <h3>Add a new device</h3>
        <p>
            Look up the navbar and go to Device/Manage/New, put the name you wish and hit Add
        </p>
    </div>
    <div class="col-md-4">
        <h3>Setup the connectivity</h3>
        <p>
            In order to connect to your devices, you must specify the data needed for that, go to Device/Settings/Connectivity
        </p>
    </div>
    <div class="col-md-4">
        <h3>Secure communication</h3>
        <p>
            If you want to encrypt the data sent to the device, go to Settings/Connectivity and put a key
        </p>
    </div>
    <div class="col-md-6">
        <h3>Add a RTV gauge</h3>
        <p>
            RTV(Real-Time-Value), as the acronym says, displays real time values sent by the devices, to add a new one, go to Settings/RTV and select a device
        </p>
    </div>
    <div class="col-md-6">
        <h3>Terminal</h3>
        <p>
            The console may serve various functions, for example, to read a digital value, first select the device with the <kbd>selectDevice:DEVICE-NAME</kbd> command and then perform <kbd>digitalRead:PIN-NUM</kbd>
        </p>
    </div>
@else
    @foreach($devices as $device)
        <!-- Device -->
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $device->name }}</h3>
                </div>
                <div class="panel-body">
                    <p class="text-center device-panel">
                        {{ long2ip($device->ip) }}:{{ $device->port }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
@endif
