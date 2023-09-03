<?php

function citiesController($uriExplode, $mims)
{
    try {
        require_once "models/mims.php";
        $mim = mimCheck($mims, ["text/*", "text/html", "application/*", "application/x-map"]);
        if (!isset($mim)) {
            require_once "NotAcceptableMimeException.php";
            throw new NotAcceptableMimeException();
        }
    } catch (MimeMissingException $e) {
        header("HTTP/1.1 406 Not Acceptable");
        header("Content-Type: text/plain");
        echo "Erreur : " . $e->getMessage();
    }

    if(count($uriExplode) <3 ) showCitiesList("cities.json");
    else
    {
        require_once "models/json.php";
        $cityInformation = findInJson("cities.json", $uriExplode[2]);
        if (!$cityInformation) {
            header("HTTP/1.1 404 Bad Request");
            header("Content-Type: text/plain");
        }
    }

    if ($cityInformation && str_contains($mim, "text")) showCityInformation($cityInformation);
    elseif ($cityInformation && str_contains($mim, "application")) showCityMap($cityInformation);
}

function showCityInformation($info) :void
{
    $message = "Welcome to " . $info['name'] . " " . $info['CP'];

    header("HTTP/1.1 200 OK");
    header("Content-Type: text/html");

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

    header("HTTP/1.1 200 OK");
    header("Content-Type: text/html");

    echo $message;
}
