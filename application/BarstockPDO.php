<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 10.12.2014
 * Time: 14:53
 */

class BarstockPDO {

    private $pdo;

    function __construct($dsn, $user, $password) {
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    function getAllBeverages() {
        // sql used to get all beverages from db
        $sqlString = "SELECT * FROM beverage";

        $beverages = array();

        try {
            // create the prepared statement
            $preparedStatement = $this->pdo->prepare($sqlString);

            // execute the prepared statement
            $preparedStatement->execute();

            while($row = $preparedStatement->fetchObject()) {
                $beverage = new Beverage($row->id, utf8_encode($row->name), utf8_encode($row->manufacturer),
                    utf8_encode($row->country), utf8_encode($row->age), utf8_encode($row->description));
                array_push($beverages, $beverage);
            }
        } catch (Exception $e) {
            print_r($e);
        }

        return $beverages;
    }

    function getBeverageWithId($id) {
        $sqlString = "SELECT * FROM beverage WHERE id = :id";

        $beverage = null;

        try {
            $preparedStatement = $this->pdo->prepare($sqlString);
            $preparedStatement->bindValue(":id", $id);
            $preparedStatement->execute();

            $object = $preparedStatement->fetchObject();

            $beverage = new Beverage($object->id, utf8_encode($object->name), utf8_encode($object->manufacturer),
                utf8_encode($object->country), $object->age, utf8_encode($object->description));

        } catch (Exception $e) {
            print_r($e);
        }

        return $beverage;
    }

    function getBeverageWithName($name) {
        $sqlString = "SELECT * FROM beverage WHERE name = :name";

        $beverage = null;

        try {
            $preparedStatement = $this->pdo->prepare($sqlString);
            $preparedStatement->bindValue(":name", $name);
            $preparedStatement->execute();

            $object = $preparedStatement->fetchObject();

            if (!empty($object)) {
                $beverage = new Beverage($object->id, utf8_encode($object->name), utf8_encode($object->manufacturer),
                    utf8_encode($object->country), $object->age, utf8_encode($object->description));
            }

        } catch (Exception $e) {
            print_r($e);
        }

        return $beverage;
    }

    function getBeverageWithPattern($pattern) {
        $sqlString = "SELECT * FROM beverage WHERE name LIKE :pattern";

        $pattern = "%$pattern%";

        $beverage = null;

        try {
            $preparedStatement = $this->pdo->prepare($sqlString);
            $preparedStatement->bindValue(":pattern", $pattern);
            $preparedStatement->execute();

            $object = $preparedStatement->fetchObject();

            if (!empty($object)) {
                $beverage = new Beverage($object->id, utf8_encode($object->name), utf8_encode($object->manufacturer),
                    utf8_encode($object->country), $object->age, utf8_encode($object->description));
            }

        } catch (Exception $e) {
            print_r($e);
        }

        return $beverage;

    }

    function getAllBeveragesWithPattern($pattern) {
        $sqlString = "SELECT * FROM beverage WHERE name LIKE :pattern";

        $pattern = "%$pattern%";

        $beverages = array();

        try {
            // create the prepared statement
            $preparedStatement = $this->pdo->prepare($sqlString);

            $preparedStatement->bindValue(":pattern", $pattern);

            // execute the prepared statement
            $preparedStatement->execute();

            while($row = $preparedStatement->fetchObject()) {
                $beverage = new Beverage($row->id, utf8_encode($row->name), utf8_encode($row->manufacturer),
                    utf8_encode($row->country), utf8_encode($row->age), utf8_encode($row->description));
                array_push($beverages, $beverage);
            }
        } catch (Exception $e) {
            print_r($e);
        }

        return $beverages;
    }

    function storeBeverage($beverage) {
        $sqlString = "INSERT INTO beverage (
            name, manufacturer, country, age, description
            ) VALUES (
            :name, :manufacturer, :country, :age, :description
            )";

        print_r($sqlString);

        try {
            $preparedStatement = $this->pdo->prepare($sqlString);

            $preparedStatement->bindValue(":name", utf8_decode($beverage->name));
            $preparedStatement->bindValue(":manufacturer", utf8_decode($beverage->manufacturer));
            $preparedStatement->bindValue(":country", utf8_decode($beverage->country));
            $preparedStatement->bindValue(":age", $beverage->age);
            $preparedStatement->bindValue(":description", utf8_decode($beverage->description));

            $preparedStatement->execute();

        } catch (Exception $e) {
            print_r($e);
        }

        return $this->pdo->lastInsertId();
    }

    function deleteBeverageWithId($id) {
        $sqlString = "DELETE FROM beverage WHERE id = :id";

        try {
            $preparedStatement = $this->pdo->prepare($sqlString);
            $preparedStatement->bindValue(":id", $id);
            $preparedStatement->execute();
            return true;
        } catch (Exception $e) {
            print_r($e);
        }

        return false;
    }

} 