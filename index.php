<?php
require_once "controller/controller.php";
require_once "controller/cities.php";

if(isset($_SERVER['REQUEST_URI'])){
    $action = explode("/", $_SERVER['REQUEST_URI']);
    $mims = $_SERVER['HTTP_ACCEPT'];

    switch($action[1]) {
        case 'people':
            if ($action[2])
            {
                controller($action[1], $action[2], $mims);
            }
            else{
                //TODO : need to check if ther's the right answer that can be given
                peopleList();
            }
            break;
        case 'cities':
            if ($action[2])
            {
                cityController($action[2], $mims);
            }
            else{
                citiesList();
            }
            break;
    }
}