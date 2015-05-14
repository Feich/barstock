<?php
/**
 * Created by PhpStorm.
 * User: uusiott
 * Date: 18.11.2014
 * Time: 10:59
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($username)) {
    $username = $_COOKIE["username"];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Barstock - Welcome</title>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/barstock.css">
</head>
<body>
<header>
    <div class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar">asd1</span>
                    <span class="icon-bar">asd2</span>
                    <span class="icon-bar">asd3</span>
                </button>
                <a class="navbar-brand" href="index.php">BarStock</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="beveragelist.php">Beverages</a></li>
                    <li><a href="addbeverage.php">Add New Beverage</a></li>
                    <li><a href="findbeverage.php">Find Beverage</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<span
                                class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a> </li>
                            <li><a href="#">Another action</a> </li>
                            <li class="divider"></li>
                            <li><a href="#">Some kind of link</a> </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<main id="content" role="main" class="barstock-index-main">
    <div class="container">
        <h1>Welcome To BarStock<?php if (isset($_COOKIE["username"])) { $username = $_COOKIE["username"]; print(", $username"); } ?></h1>

        <p>Keep record of your favorite beverages</p>
    </div>
</main>
</body>
</html>