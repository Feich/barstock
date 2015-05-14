<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 15.12.2014
 * Time: 10:39
 */

require_once "BarstockPDO.php";
require_once "Beverage.php";

$dataRepository = new BarstockPDO("mysql:host=localhost;dbname=a1200100", "root", "salainen");

$result = $dataRepository->getAllBeverages();

print(json_encode($result));

?>