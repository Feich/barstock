<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 26.11.2014
 * Time: 19:11
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$changeNameIsSuccessful = false;
if (isset($_POST["submit-user-name"])) {
    setcookie("username", $_POST["user-name"], time() + 60*60*24*7);
    $changeNameIsSuccessful = true;
}
if (isset($_POST["cancel-user-name"])) {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Barstock - Settings</title>
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
                    <li class="active"><a href="settings.php">Settings</a></li>
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
        <h1>Barstock Settings</h1>

        <p>Here be settings</p>
        <?php
        if($changeNameIsSuccessful) {
            print("<div class='alert alert-success alert-dismissable' role='alert'>
                    <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                    <strong>Success!</strong> You have successfully changed the user name
                </div>");
        }
        ?>
        <form role="form" class="form-horizontal" method="post">
            <div class="form-group">
                <label for="settings-form-user-name" class="col-sm-2 control-label">Your name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="settings-form-user-name" name="user-name"
                           placeholder="Enter your name" value="<?php if (isset($_COOKIE['username'])) { print($_COOKIE['username']); } ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <button type="submit" name="submit-user-name" class="btn btn-default">Change name</button>
                </div>
                <div class="col-sm-2">
                    <button type="submit" name="cancel-user-name" class="btn">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</main>
</body>
</html>