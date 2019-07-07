<?php
if (isset($_SESSION['LoggedIn'])) {
    if (!$_SESSION['LoggedIn']) {
        header('Location:'.URL.'start/unlogged');
    }
} else {
    header('Location:'.URL.'start/unlogged');
}

if (isset($_SESSION['station'])) {
    $station = $_SESSION['station'];
} else {
    $station = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Haus 5 - Potsdam</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/jquery/jquery-ui-1.12.1/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="public/css/print.css" media="print">
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
                        <a class="nav-link" href="<?php echo URL; ?>start">Start</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="<?php echo URL; ?>hinzufuegen">Anreise addieren</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="<?php echo URL; ?>karte">Karte</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="<?php echo URL; ?>plan">Plan</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="<?php echo URL; ?>liste">Liste</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="<?php echo URL; ?>zimmern">Zimmern verfügen</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown ml-5">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">Station <?php echo $station; ?>: </a>
                    <div class="dropdown-menu">
                        <a href="<?php echo URL; ?>/start/station/1" class="dropdown-item">Station 1</a>
                        <a href="<?php echo URL; ?>/start/station/2" class="dropdown-item">Station 2</a>
                        <a href="<?php echo URL; ?>/start/station/3" class="dropdown-item">Station 3</a>
                        <a href="<?php echo URL; ?>/start/station/4" class="dropdown-item">Station 4</a>
                        <a href="<?php echo URL; ?>/start/station/5" class="dropdown-item">Station 5</a>
                        <a href="<?php echo URL; ?>/start/station/6" class="dropdown-item">Station 6</a>
                        <a href="<?php echo URL; ?>/start/station/7" class="dropdown-item">Station 7</a>
                        <a href="<?php echo URL; ?>/start/station/8" class="dropdown-item">Station 8</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="<?php echo URL; ?>start/logout" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>