<?php
/**
 * Created by PhpStorm.
 * User: a1200100
 * Date: 10.12.2014
 * Time: 15:01
 */

class PDOConfig extends PDO {

    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;

    function __construct($engine, $host, $database, $user, $pass) {
        $this->engine = $engine;
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->pass = $pass;
    }

} 