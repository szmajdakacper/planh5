<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Haus 5 - Potsdam</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/jquery/jquery-ui-1.12.1/jquery-ui.css">
    <script type="text/javascript" src="<?php echo URL; ?>public/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/jquery/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/bootstrap/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-success p-3">
            <a class="navbar-brand" href="<?php echo URL; ?>">Haus Potsdam</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav"><span
                    class="navbar-toggler-icon"></span></button>
            <div id="navbarNav" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled" href="#">Start</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled" href="#">Zimmer addieren</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled" href="#">Karte</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled" href="#">Plan</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link disabled" href="#">Liste</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php $_SESSION['returnTo'] = URL."start"; ?>
        <div class="content p-5 bg-light text-center">
            <h3 class="display-3">Herzlich Wilkommen!</h3>
            <div class="jumbotron">
                <div class="row text-center">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div class="form-inline">
                            <form action="<?php echo URL; ?>start/login" method="post">
                                <label class="w-100 mb-3">Bitte loggen Sie sich ein:</label>
                                <hr />
                                <input type="text" name="login" class="form-control w-100" placeholder="Login...">	
                                <input type="password" name="pass" class="form-control w-100" placeholder="Password...">
                                <input type="submit" value="Login" class="btn btn-block btn-outline-success">
                            </form>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>    
            </div>
        </div>

        <div class="bg-success text-dark text-center py-2">
            <p class="lead">HAUS POTSDAM</p>
        </div>
      
    </div>
</body>
</html>
