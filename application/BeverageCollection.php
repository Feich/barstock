<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 26.11.2014
 * Time: 19:16
 */

class BeverageCollection {

    private $beverageArray;
    private $created;
    private $modified;

    function __construct($beverages, $creationDate, $modificationDate) {
        $this->beverageArray = $beverages;
        $this->created = $creationDate;
        $this->modified = $modificationDate;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }

    public function addBeverage($beverage) {
        if ($beverage instanceof Beverage) {
            array_push($this->beverageArray, $beverage);
            $this->modified = new DateTime();
        }
    }

    public function getSpecificBeverage($index) {
        return $this->beverageArray[$index];
    }

} 