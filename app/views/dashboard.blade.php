<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
        <meta name="signet:authors" content="Michael Paleo">
        <meta name="signet:links" content="http://github.com/mPaleo, http://twitter.com/PaleoMichael">
        <title>[Project name]</title>

        <!-- Pace loader -->
        <script src="components/pace/pace.min.js"></script>
        <link rel="stylesheet" href="css/pace-theme.min.css">
        <script>
            // Pace loader
            Pace.once('done', function()
            {
                $('.content-body').fadeIn('slow');
            });
        </script>

        <!-- Font awesome -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Page style -->
        <link rel="stylesheet" href="css/dashboard-main.min.css">

        <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


        <!-- Navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">[Project name]</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="#" id="btn-terminal" data-toggle="collapse" data-target=".navbar .in">Terminal</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Device <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li class="dropdown-header"><i class="fa fa-database"></i>&nbsp;&nbsp;Data</li>
                                <li><a href="#" data-toggle="modal" data-target="#shared-data-modal">Shared</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#device-data-modal">Device</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#quick-data-modal">Quick</a></li>


                                <li class="divider"></li>
                                <li class="dropdown-header"><i class="fa fa-cloud"></i>&nbsp;&nbsp;Settings</li>
                                <li><a href="#" data-toggle="modal" data-target="#connectivity-modal">Connectivity</a></li>

                                <li class="divider"></li>
                                <li class="dropdown-header"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Manage</li>
                                <li><a href="#" data-toggle="modal" data-target="#add-device-modal">New</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#delete-device-modal">Delete</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
                            <ul class="dropdown-menu">

                                <li><a href="#" data-toggle="modal" data-target="#settings-modal">General</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#voice-modal">Voice</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Page content -->
        <div class="container content-body">
            <div class="row">


                <!-- Head -->
                <div class="col-lg-12 content-header">
                    <h1 class="text-center">Dashboard</h1>
                </div>


                <!-- Device -->
                <div class="col-sm-12">
                    <h2>Devices</h2>
                </div>
                @include('dashboard.devices')


                <!-- RTVs -->
                <div class="col-sm-12">
                    <h2>RTVs</h2>
                </div>
                @include('dashboard.rtv')


            </div><hr>


            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-6">
                        <p class="text-right">Released under the <a href="#">MIT</a> Licence</p>
                    </div>
                </div>
            </footer>
        </div>


        <!-- Terminal -->
        <div class="terminal">


            <!-- Output -->
            <div id="terminal-output"></div>


            <!-- Input-->
            <span>&gt;</span>
            <input type="text" class="terminal-input" autocomplete="off"/>


        </div>


        @include('dashboard.modal.settings')

        @include('dashboard.modal.settings.voice')

        @include('dashboard.modal.device.add')

        @include('dashboard.modal.device.delete')

        @include('dashboard.modal.device.connectivity')

        @include('dashboard.modal.device.data')

        @include('dashboard.modal.device.data-shared')

        @include('dashboard.modal.device.data-quick')


        <!-- JQuery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <!-- Touch swipe -->
        <script src="components/jquery-touchswipe/jquery.touchSwipe.min.js"></script>

        <!-- Bootstrap select -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.3.5/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.3.5/bootstrap-select.min.css">

        <!-- iCheck -->
        <link rel="stylesheet" href="components/jquery-icheck/skins/square/blue.css">
        <script src="components/jquery-icheck/icheck.min.js"></script>

        <!-- Data table -->
        <script src="//cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">

        <!-- Notify.js -->
        <script src="components/notify.js/notify.js"></script>

        <!-- Annyang -->
        <script src="components/annyang/annyang.min.js"></script>

        <!-- Signet -->
        <!-- <script src="components/signet/signet.min.js"></script> -->

        <!-- Ace editor -->
		<script src="//cdn.jsdelivr.net/ace/1.1.6/min/ace.js"></script>
		<script src="//cdn.jsdelivr.net/ace/1.1.6/min/mode-javascript.js"></script>
		<script src="//cdn.jsdelivr.net/ace/1.1.6/min/theme-tomorrow_night_eighties.js"></script>

        <!-- Dev -->
        <script src="js/src/bootstrap.min.js"></script>
        <script src="js/src/script-dashboard.js"></script>

    </body>
</html>
