<?php
require_once "controller/people.php";
require_once "controller/cities.php";

if(isset($_SERVER['REQUEST_URI'])){
    $request = explode("/", $_SERVER['REQUEST_URI']);
    $mims = explode(",", $_SERVER['HTTP_ACCEPT']);
    try {
        if (!isset($_SERVER['HTTP_ACCEPT'])) {
            require_once "MimeMissingException.php";
            throw new MimeMissingException();
        }
    } catch (MimeMissingException $e) {
        header("HTTP/1.1 415 Unsupported Media Type");
        header("Content-Type: text/plain");
        echo "Erreur : " . $e->getMessage();
    }

    match($request[1]) {
        'people' => peopleController($request, $mims),
        'cities' => citiesController($request, $mims),
        '' => require_once __DIR__ . "/view/home.php"
    };
}

