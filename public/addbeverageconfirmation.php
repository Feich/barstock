<?php
/**
 * Created by PhpStorm.
 * User: uusiott
 * Date: 1.12.2014
 * Time: 17:24
 */
require "../application/Beverage.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$unconfirmedBeverage = $_SESSION["unconfirmedBeverage"];

if (isset($_POST["confirm"])) {

    try {
        require_once "../application/BarstockPDO.php";

        $dataRepository = new BarstockPDO("mysql:host=localhost;dbname=a1200100", "root", "salainen");

        $dataRepository->storeBeverage($unconfirmedBeverage);

    } catch (Exception $e) {
        print_r($e);
    }

    $_SESSION["recentlyConfirmedBeverage"] = $unconfirmedBeverage;
    $_SESSION["unconfirmedBeverage"] = null;
    $_SESSION["addBeverageIsSuccessful"] = true;
    header("location: addbeverage.php");
    exit;
}
if (isset($_POST["modify"])) {
    header("location: addbeverage.php");
    exit;
}
if (isset($_POST["cancel"])) {
    $_SESSION["unconfirmedBeverage"] = null;
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Barstock - Beverages</title>
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
                    <li class="active"><a href="addbeverage.php">Add New Beverage</a></li>
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
        <h1>Add new Beverage</h1>

        <h4>You gave the following information</h4>
        <?php

            print("<p>
                <ul>
                    <li>Name: $unconfirmedBeverage->name</li>
                    <li>Manufacturer: $unconfirmedBeverage->manufacturer</li>
                    <li>Country: $unconfirmedBeverage->country</li>
                    <li>Age: $unconfirmedBeverage->age</li>
                    <li>Description: $unconfirmedBeverage->description</li>
                </ul>
            </p>");
        ?>
        <form name="confirmationForm" method="post">
            <button class="btn btn-primary" type="submit" name="confirm">Add</button>
            <button class="btn" type="submit" name="modify">Modify</button>
            <button class="btn" type="submit" name="cancel">Cancel</button>
        </form>
    </div>
</main>
</body>
</html>