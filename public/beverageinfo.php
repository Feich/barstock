<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 10.12.2014
 * Time: 16:26
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST["return-to-list"])) {
    header("location: beveragelist.php");
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
                    <li class="active"><a href="beveragelist.php">Beverages</a></li>
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
        <h1>Expanded information</h1>
        <?php
        try {
            require_once "../application/BarstockPDO.php";
            require_once "../application/Beverage.php";

            $beverageId = $_SESSION["beverageToShowId"];

            $dataRepository = new BarstockPDO("mysql:host=localhost;dbname=a1200100", "root", "salainen");

            $beverage = $dataRepository->getBeverageWithId($beverageId);

            print("<p>
                <ul>
                    <li>Name: $beverage->name</li>
                    <li>Manufacturer: $beverage->manufacturer</li>
                    <li>Country: $beverage->country</li>
                    <li>Age: $beverage->age</li>
                    <li>Description: $beverage->description</li>
                </ul>
            </p>");

        } catch (Exception $e) {
            print_r($e);
        }

        print("<form method='post'><button class='btn' name='return-to-list'>Return</button></form>");
        ?>
    </div>
</main>
</body>
</html>