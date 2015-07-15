<?php
/**
 * Created by PhpStorm.
 * User: uusiott
 * Date: 11.12.2014
 * Time: 13:01
 */

require_once "BarstockPDO.php";
require_once "Beverage.php";

$dataRepository = new BarstockPDO("mysql:host=localhost;dbname=database", "username", "password");

if (isset($_GET["beveragename"])) {
    $result = $dataRepository->getAllBeveragesWithPattern($_GET["beveragename"]);
    print(json_encode($result));
}

?>
