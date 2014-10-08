<!-- Modal/Settings -->
<div id="settings-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">General settings</h4>
            </div>
            <div class="modal-body">



                <!-- Connectivity -->
                <h4>Connectivity</h4>
                <form id="form-settings-key" action="/settings/key" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="key" class="form-control" type="text" placeholder="Key to encrypt" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit">Apply</button>
                            </span>
                        </div>
                    </div>
                </form>

                <!-- Alerts -->
                <div id="settings-key-alert-success" class="alert alert-success">
                    <strong>Well done!</strong> You successfully updated the key
                </div>
                <div id="settings-key-alert-error" class="alert alert-danger">
                    <strong>Woops!</strong> Some internal error has ocurred
                </div>
                <hr>



                <!-- RTV -->
                <h4>RTV <small>(Real Time Value)</small></h4>
                <ul class="nav nav-tabs nav-justified" style="margin-bottom: 15px;">
                    <li class="active">
                        <a href="#rtv-add" data-toggle="tab">Add</a>
                    </li>
                    <li>
                        <a href="#rtv-notifications" data-toggle="tab">Notifications</a>
                    </li>
                    <li>
                        <a href="#rtv-delete" data-toggle="tab">Delete</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">



                    <!-- Add RTV -->
                    <div class="tab-pane fade active in" id="rtv-add">
                        <form id="form-settings-rtv-add" action="/rtv/add" method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="RTV name" name="name" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm btn-block">Add</button>
                            </div>
                        </form>

                        <!-- Alerts -->
                        <div id="settings-rtv-add-alert-success" class="alert alert-success">
                            <strong>Well done!</strong> You successfully created a new RTV. <a href="/" class="alert-link">Refresh to see changes</a>
                        </div>
                        <div id="settings-rtv-add-alert-info" class="alert alert-info">
                            <strong>Heads up!</strong> Already exists a RTV with that name
                        </div>
                        <div id="settings-rtv-add-alert-error" class="alert alert-danger">
                            <strong>Woops!</strong> Some internal error has ocurred
                        </div>
                    </div>



                    <!-- Notifications RTV -->
                    <div class="tab-pane fade" id="rtv-notifications">
                        <form id="form-settings-rtv-notification" action="/rtv/notification" method="post">
                            <div class="form-group">
                                <select name="name" data-live-search="true" data-width="100%">
                                    @if($rtvs->isEmpty())
                                        <option value="default-value" selected="selected">Without RTVs</option>
                                    @else
                                        @foreach($rtvs as $rtv)
                                            <option value="{{ $rtv->name }}">{{ $rtv->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" placeholder="Min edge" name="min" autocomplete="off">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input class="form-control" type="text" placeholder="Max edge" name="max" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm btn-block">Apply</button>
                            </div>
                        </form>

                        <!-- Alerts -->
                        <div id="settings-rtv-notification-alert-success" class="alert alert-success">
                            <strong>Well done!</strong> You successfully created a RTV notification. <a href="/" class="alert-link">Refresh to see changes</a>
                        </div>
                        <div id="settings-rtv-notification-alert-info" class="alert alert-info">
                            <strong>Heads up!</strong> Doesn't exists a RTV with that name
                        </div>
                        <div id="settings-rtv-notification-alert-error" class="alert alert-danger">
                            <strong>Woops!</strong> Some internal error has ocurred
                        </div>
                    </div>



                    <!-- Delete RTV -->
                    <div class="tab-pane fade" id="rtv-delete">
                        <form id="form-settings-rtv-delete" action="/rtv/delete" method="post">
                            <div class="form-group">
                                <select name="name" data-live-search="true" data-width="100%">
                                    @if($rtvs->isEmpty())
                                        <option value="default-value" selected="selected">Without RTVs</option>
                                    @else
                                        @foreach($rtvs as $rtv)
                                            <option value="{{ $rtv->name }}">{{ $rtv->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-sm btn-block">Delete</button>
                            </div>
                        </form>

                        <!-- Alerts -->
                        <div id="settings-rtv-delete-alert-success" class="alert alert-success">
                            <strong>Well done!</strong> You successfully deleted a RTV. <a href="/" class="alert-link">Refresh to see changes</a>
                        </div>
                        <div id="settings-rtv-delete-alert-info" class="alert alert-info">
                            <strong>Heads up!</strong> Doesn't exists a RTV with that name
                        </div>
                        <div id="settings-rtv-delete-alert-error" class="alert alert-danger">
                            <strong>Woops!</strong> Some internal error has ocurred
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
