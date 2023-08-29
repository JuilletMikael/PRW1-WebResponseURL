<?php
require_once "controller/people.php";
require_once "controller/cities.php";

if(isset($_SERVER['REQUEST_URI'])){
    $action = explode("/", $_SERVER['REQUEST_URI']);
    $headers = $_SERVER['HTTP_ACCEPT'];

    // TODO : change number in variables
    switch($action[1]) {
        case 'people':
            if ($action[2])
            {
             getPerson($action[2], $headers);
            }
            else{
                peopleList();
            }
            break;
        case 'cities':
            citiesController($action);
            break;
    }
}