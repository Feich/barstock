<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 15.12.2014
 * Time: 9:38
 */

require_once "../application/Beverage.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$beveragename = null;

if (isset($_GET["beverage-name"])) {
    $beveragename = $_GET["beverage-name"];
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
<script>
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var response = JSON.parse(xmlhttp.responseText);
            var responseText = "";
            var findResultDiv = document.getElementById("find-result").innerHTML;
            for (var i = 0; i < response.length; ++i) {
                var nameLi = "<li>Name: " + response[i].name + "</li>"
                var manufacturerLi = "<li>Manufacturer: " + response[i].manufacturer + "</li>";
                var countryLi = "<li>Country: " + response[i].country + "</li>";
                var ageLi = "<li>Age: " + response[i].age + "</li>";
                var descriptionLi = "<li>Description: " + response[i].description + "</li>";
                document.getElementById("find-result").innerHTML += "<p><ul>" + nameLi + manufacturerLi + countryLi + ageLi + descriptionLi + "</ul><p>";
            }
            document.getElementById("json-load-message").innerHTML = "Load complete";
        }
    }

    xmlhttp.open("GET", "http://localhost:8080/Barstock/application/BeverageJSON.php?beveragename=<?php
        if (!empty($beveragename))  {
            print($beveragename);
        }
        ?>", true);
    xmlhttp.send();
</script>
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
                    <li class="active"><a href="findbeverage.php">Find Beverage</a></li>
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
        <h1>Find beverage (JSON)</h1>
        <form role="form" class="form-horizontal" method="get">
            <div class="form-group">
                <label for="json-form-beverage-name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="json-form-beverage-name" name="beverage-name"
                           placeholder="Enter name of beverage">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" class="btn btn-primary">Find</button>
                </div>
            </div>
        </form>
        <span style="color: green" id="json-load-message"></span>
        <div id="find-result"></div>
        <span id="test"></span>
    </div>
</main>
</body>
</html>