<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 26.11.2014
 * Time: 19:08
 */
require "../application/BeverageCollection.php";
require "../application/Beverage.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["show-beverage"])) {
    $beverageId = $_POST["show-beverage"];
    $_SESSION["beverageToShowId"] = $beverageId;
    header("location: beverageinfo.php");
    exit;
}
if (isset($_POST["remove-beverage"])) {
    $beverageId = $_POST["remove-beverage"];
    try {
        require_once "../application/BarstockPDO.php";

        $dataRepository = new BarstockPDO("mysql:host=localhost;dbname=a1200100", "root", "salainen");

        $dataRepository->deleteBeverageWithId($beverageId);

        $_SESSION["removeSuccessful"] = true;
    } catch (Exception $e) {
        print_r($e);
    }
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
        <h1>Beverages</h1>
        <?php

        if (isset($_SESSION["removeSuccessful"])) {
            if ($_SESSION["removeSuccessful"]) {
                print("<div class='alert alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                    <strong>Success!</strong> You have successfully removed the selected beverage
                </div>");
                $_SESSION["removeSuccessful"] = false;
            }
        }

        try {
            require_once "../application/BarstockPDO.php";

            $dataRepository = new BarstockPDO("mysql:host=localhost;dbname=a1200100", "root", "salainen");

            $beverages = $dataRepository->getAllBeverages();

            if ($beverages != null && !empty($beverages)) {
                print("<table class='table'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Manufacturer</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>");
                foreach($beverages as $beverage) {
                    print("<tr>
                        <form method='post'>
                            <td>$beverage->name</td>
                            <td>$beverage->manufacturer</td>
                            <td><button class='btn' type='submit' name='show-beverage' value='$beverage->id'>Show</button></td>
                            <td><button class='btn' type='submit' name='remove-beverage' value='$beverage->id'>Remove</button></td>
                        </form>
                    </tr>");
                }
                print("</tbody></table>");
            } else {
                print("<p>List is empty</p>");
            }

        } catch (Exception $e) {
            print_r($e);
        }
        ?>
    </div>
</main>
</body>
</html>