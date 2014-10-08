@if($rtvs->isEmpty())
    <!-- Quickstart -->
    <div class="col-sm-12">
        <h2 class="text-right lead">Minimal setup</h2>
        <hr>
    </div>
    <div class="col-sm-6">
        <h3>Add a new rtv</h3>
        <p>
            Look up the navbar and go to Settings/RTV/Add, put the name you wish and hit Add
        </p>
    </div>
    <div class="col-sm-6">
        <h3>Push some values</h3>
        <p>
            Just push some values from a device and you are done
        </p>
    </div>
@else
    @foreach($rtvs as $rtv)
        <!-- RTV -->
        <div class="col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ $rtv->name }}
                        <i id="{{ $rtv->name }}-indicator" class="fa fa-minus pull-right"></i>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div id="{{ $rtv->name }}" class="col-lg-10 col-lg-offset-1 rtv-container">
                            <img src="img/loader.GIF" alt="Loading" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- RTV values -->
    <script>
        setInterval(function()
        {
            @foreach($rtvs as $rtv)
                $.post('/rtv', { name: "{{ $rtv->name }}" }, function(data){

                    if($('#{{ $rtv->name }}').text() > data.content)
                    {
                        $("#{{ $rtv->name }}-indicator").removeClass('fa-minus fa-caret-up').addClass('fa-caret-down');

                        //Show rtv notification
                        if(data.notify == '1')
                        {
                            showNotification(data.content);
                        }
                    }
                    else if($('#{{ $rtv->name }}').text() < data.content)
                    {
                        $("#{{ $rtv->name }}-indicator").removeClass('fa-minus fa-caret-down').addClass('fa-caret-up');

                        //Show rtv notification
                        if(data.notify == '1')
                        {
                            showNotification(data.content);
                        }
                    }
                    else
                    {
                        $("#{{ $rtv->name }}-indicator").removeClass('fa-caret-up fa-caret-down').addClass('fa-minus');
                    }

                    //Set value
                    $('#{{ $rtv->name }}').text(data.content);

                });
            @endforeach
        }, 5000);

        // Notify.js
        function showNotification(value)
        {
            function onShowNotification ()
            {
                console.log('Notification is shown!');
            }

            function onCloseNotification ()
            {
                console.log('Notification is closed!');
            }

            function onClickNotification ()
            {
                console.log('Notification was clicked!');
            }

            function onErrorNotification ()
            {
                console.error('Error showing notification. You may need to request permission.');
            }

            function onPermissionGranted ()
            {
                console.log('Permission has been granted by the user');
                doNotification();
            }

            function onPermissionDenied ()
            {
                console.warn('Permission has been denied by the user');
            }

            function doNotification ()
            {
                var myNotification = new Notify('RTV notification !', {
                    body: 'Value: ' + value,
                    icon: '../img/integrated_circuit.ico',
                    notifyShow: onShowNotification,
                    notifyClose: onCloseNotification,
                    notifyClick: onClickNotification,
                    notifyError: onErrorNotification,
                    timeout: 10
                });
                myNotification.show();
            }
            if(Notify.needsPermission)
            {
                Notify.requestPermission(onPermissionGranted, onPermissionDenied);
            }
            else
            {
                doNotification();
            }
        }
    </script>
@endif
