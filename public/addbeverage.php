<?php
/**
 * Created by PhpStorm.
 * User: uusiott
 * Date: 18.11.2014
 * Time: 11:00
 */
require_once "../application/Beverage.php";
require_once "../application/BeverageFormValidator.php";
require "../application/BeverageCollection.php";

// check if session exists
// if not, start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// load the beverage information from the session
if (isset($_SESSION["unconfirmedBeverage"])) {
    $sessionBeverage = $_SESSION["unconfirmedBeverage"];
}

// get the form information and process
if(isset($_POST["submit-beverage"])) {
    $isSuccessful = false;

    $beverageName = $_POST["beverage-name"];
    $manufacturerName = $_POST["manufacturer-name"];
    $countryName = $_POST["country-name"];
    $beverageAge = $_POST["beverage-age"];
    $beverageDescription = $_POST["beverage-description"];

    $beverage = new Beverage(0, $beverageName, $manufacturerName, $countryName, $beverageAge, $beverageDescription);
    $_SESSION["unconfirmedBeverage"] = $beverage;
    // initialize the validator
    $validator = new BeverageFormValidator();

    // gather errors for all inputs
    $nameErrors = $validator->validateBeverageName($beverageName);
    $manufacturerErrors = $validator->validateManufacturerName($manufacturerName);
    $countryErrors = $validator->validateBeverageCountry($countryName);
    $ageErrors = $validator->validateBeverageAge($beverageAge);
    $descriptionErrors = $validator->validateBeverageDescription($beverageDescription);

    // if valid, create new Beverage and add it to the collection of beverages in the session
    if (empty($descriptionErrors) && empty($nameErrors) && empty($manufacturerErrors) && empty($countryErrors) &&
        empty($ageErrors)) {

        // create array that contains beverages and add beverage into it
        // get the beverages from the session
        //$beverages = $_SESSION["beverages"];
        // add the new beverage to the array
        //array_push($beverages, $beverage);
        // add the modified array to the session
        //$_SESSION["beverages"] = $beverages;

        //$isSuccessful = true;

        header("location: addbeverageconfirmation.php");
        exit;
    }

} elseif (isset($_POST["cancel-beverage"])) {
    header("location: index.php");
    exit;
} else {
    $isSuccessful = false;
    $countryErrors = array();
    $nameErrors = array();
    $ageErrors = array();
    $manufacturerErrors = array();
    $descriptionErrors = array();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Barstock - Add new beverage</title>
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
<main role="main" id="content" class="barstock-beverage-form-main">
    <div class="container">
        <h1>Add new Beverage</h1>
        <?php
        if (isset($_SESSION["addBeverageIsSuccessful"])) {
            if($_SESSION["addBeverageIsSuccessful"]) {
                print("<div class='alert alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                    <strong>Success!</strong> You have successfully added a new beverage
                </div>");
                $_SESSION["addBeverageIsSuccessful"] = false;
            }
        }
        ?>
        <p>Enter the details of the beverage</p>
        <form role="form" class="form-horizontal" method="post">
            <div class="form-group">
                <label for="beverage-form-beverage-name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="beverage-form-beverage-name" name="beverage-name"
                           placeholder="Enter name of beverage" value="<?php if (isset($sessionBeverage)) {
                        print($sessionBeverage->name);
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="beverage-form-manufacturer-name" class="col-sm-2 control-label">Manufacturer</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="beverage-form-manufacturer-name" name="manufacturer-name"
                           placeholder="Enter manufacturer name" value="<?php if (isset($sessionBeverage)) {
                        print($sessionBeverage->manufacturer);
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="beverage-form-country-name" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="beverage-form-country-name" name="country-name"
                           placeholder="Enter country of origin" value="<?php if (isset($sessionBeverage)) {
                        print($sessionBeverage->country);
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="beverage-form-beverage-age" class="col-sm-2 control-label">Age</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="beverage-form-beverage-age" name="beverage-age"
                           placeholder="Enter age of beverage" value="<?php if (isset($sessionBeverage)) {
                        print($sessionBeverage->age);
                    } ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="beverage-form-description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-6">
                    <textarea name="beverage-description" id="beverage-form-description"><?php if (isset($sessionBeverage)) {
                            print($sessionBeverage->description);
                        } ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" name="submit-beverage" class="btn btn-primary">Add</button>
                </div>
                <div>
                    <button type="submit" name="cancel-beverage" class="btn">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</main>
</body>
</html>