<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
        <title>[Project name]</title>
        <!-- Page style -->
        <link rel="stylesheet" href="css/login-main.min.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <form class="form-signin" action="/login" method="post">
                <h2 class="form-signin-heading">[Project name]</h2>
                <input type="text" class="form-control" placeholder="Name" name="name" required>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                {{ Form::token() }}
            </form>

            <div class="alert alert-danger">
                <strong>Oh snap!</strong> Change a few things up and try submitting again :)
            </div>
        </div>

        <!-- JQuery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- Main script -->
        <script src="js/login-main.min.js"></script>
    </body>
</html>
