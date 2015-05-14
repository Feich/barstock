<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 18.11.2014
 * Time: 16:06
 */

class BeverageFormValidator {

    private $forbiddenCharacters = array(
        0 => '!',
        1 => '#',
        2 => '*',
        3 => '<',
        4 => '>',
        5 => '?'
    );


    function validateBeverage($beverage) {
        $findings = array();

        return $findings;
    }

    function validateBeverageName($beverageName) {
        $nameErrors = array();
        if (is_string($beverageName)) {
            if (strlen($beverageName) > 100) {
                array_push($nameErrors, "Name is too long");
            }
            if (strlen($beverageName) < 3) {
                array_push($nameErrors, "Name is too short");
            }
            // check if name contains forbidden characters
            $this->checkForForbiddenCharacters($beverageName, "Beverage Name", $nameErrors);
        } elseif (!is_string($beverageName)) {
            array_push($nameErrors, "The name is not a string");
        }
        return $nameErrors;
    }

    function checkForForbiddenCharacters($string, $field, $errorArray) {
        foreach ($this->forbiddenCharacters as $character) {
            if (strpos($string, $character) !== false) {
                $message = $field + " contains forbidden character " + $character;
                array_push($errorArray, $message);
            }
        }
    }

    function validateManufacturerName($manufacturerName) {
        $manufacturerErrors = array();
        if (is_string($manufacturerName)) {
            if (strlen($manufacturerName) > 100) {
            array_push($manufacturerErrors, "Manufacturer is too long");
            }
            if (strlen($manufacturerName) < 3) {
                array_push($manufacturerErrors, "Manufacturer is too short");
            }
            $this->checkForForbiddenCharacters($manufacturerName, "Manufacturer Name", $manufacturerErrors);
        } elseif (!is_string($manufacturerName)) {
            array_push($manufacturerErrors, "Manufacturer name is not a string");
        }
        return $manufacturerErrors;
    }

    function validateBeverageCountry($countryName) {
        $countryNameErrors = array();
        if (is_string($countryName)) {
            if (strlen($countryName) > 100) {
                array_push($countryNameErrors, "Country is too long");
            }
            if (strlen($countryName) < 3) {
                array_push($countryNameErrors, "Country is too short");
            }
            $this->checkForForbiddenCharacters($countryName, "Country Name", $countryNameErrors);
        } elseif (!is_string($countryName)) {
            array_push($countryNameErrors, "Country name is not a string");
        }
        return $countryNameErrors;
    }

    function validateBeverageAge($beverageAge) {
        $ageErrors = array();
        $ageAsInt = intval($beverageAge);
        if ($ageAsInt < 0) {
            array_push($ageErrors, "Age cannot be less than 0");
        }
        return $ageErrors;
    }

    function validateBeverageDescription($beverageDescription) {
        $descriptionErrors = array();
        if (is_string($beverageDescription)) {
            if (strlen($beverageDescription) > 1500) {
                array_push($descriptionErrors, "Description is too long");
            }
            $this->checkForForbiddenCharacters($beverageDescription, "Beverage Description", $descriptionErrors);
        }
        return $descriptionErrors;
    }

} 