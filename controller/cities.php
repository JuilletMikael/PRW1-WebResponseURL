<?php

function citiesController($uriExplode, $mims)
{
    require_once "models/mims.php";
    $mim = mimCheck($mims, ["text/*", "text/html", "application/*", "application/x-map"]); //TODO : If doesnt exist trow an error

    if(count($uriExplode) <3 ) showCitiesList("cities.json");
    else
    {
        require_once "models/json.php";
        $cityInformation = findInJson("cities.json", $uriExplode[2]);
    }
    //TODO : If it doesn't exist throw error

    if ($cityInformation && str_contains($mim, "text")) showCityInformation($cityInformation);
    elseif ($cityInformation && str_contains($mim, "application")) showCityMap($cityInformation);
}

function showCityInformation($info) :void
{
    $message = "Welcome to " . $info['name'] . " " . $info['CP'];
    echo $message;
}

function showCityMap($info) :void
{
    header("Location:" . $info['GoogleMaps']);
}

function showCitiesList($jsonFilePath) :void
{
    $file =  file_get_contents($jsonFilePath);
    $content = json_decode($file, true);
    $message = "All CP's available ";

    foreach ($content as $value){
        $message .= $value['CP'] . "; ";
    }

    echo $message;
}
