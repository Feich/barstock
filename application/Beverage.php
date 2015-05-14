<?php
/**
 * Created by PhpStorm.
 * User: uusiott
 * Date: 16.11.2014
 * Time: 19:51
 */

class Beverage implements JsonSerializable {

    private $id;
    private $name;
    private $manufacturer;
    private $country;
    private $age;
    private $description;

    function __construct($id, $name, $manufacturer, $country, $age, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->manufacturer = $manufacturer;
        $this->country = $country;
        $this->age = $age;
        $this->description = $description;
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

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "manufacturer" => $this->manufacturer,
            "country" => $this->country,
            "age" => $this->age,
            "description" => $this->description
        ];
    }

} 