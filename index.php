<?php
require_once "controller/people.php";
require_once "controller/cities.php";

if(isset($_SERVER['REQUEST_URI'])){
    $request = explode("/", $_SERVER['REQUEST_URI']);
    $mims = explode(",", $_SERVER['HTTP_ACCEPT']);

    match($request[1]) {
        'people' => peopleController($request, $mims),
        'cities' => citiesController($request, $mims),
        '' => require_once __DIR__ . "/view/home.php"
    };
}