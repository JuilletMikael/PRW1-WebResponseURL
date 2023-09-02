<?php
require_once "controller/controller.php";

if(isset($_SERVER['REQUEST_URI'])){
    $request = $_SERVER['REQUEST_URI'];
    $mims = explode(",", $_SERVER['HTTP_ACCEPT']);

    match($request) {
        '/people' => peopleController($request, $mims),
        '/cities' => citiesController($request, $mims),
        '/' => require_once __DIR__ . "/view/home.php"
    };
}