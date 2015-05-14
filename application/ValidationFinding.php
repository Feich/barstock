<?php
/**
 * Created by PhpStorm.
 * User: uusiott
 * Date: 16.11.2014
 * Time: 19:55
 */

class ValidationFinding {

    private $id;
    private $level;
    private $message;

    function __construct($id, $level, $message) {
        $this->id = $id;
        $this->level = $level;
        $this->message = $message;
    }

} 