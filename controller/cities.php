<?php
//TODO : Use php 8 variable with type (string, int, etc);

function citiesList() : void
{
    echo(require_once "people.json");
}

function cityController($city, $headers) : void
{
    if (str_contains($headers, "image")){
        echo "image";
        cityImage($city);
    }
    elseif (str_contains($headers, "text"))
    {
        echo "info";
        cityInfo($city);
    }
    //TODO return something if anything
}

//TODO : test if person exeits

function cityInfo($citySearched): void
{
    $file =  file_get_contents("cities.json");
    $cities = json_decode($file, true);

    foreach ($cities as $city)
    {
        if ($citySearched == $city['id'])
            echo($city);
        return;
        // TODO return 200
    }
    echo "The id isn't found !";
    //TODO : return error 400
}

function cityImage($citySearched): void
{
    $imageDirectory = "/image/";
    $imageFile = $imageDirectory . $citySearched . ".jpg";

    if (file_exists($imageFile))
    {

        return;
    }
    // TODO return 200
    echo "The id isn't found !";
}