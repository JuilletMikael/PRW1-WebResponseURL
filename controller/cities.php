<?php
//TODO : Use php 8 variable with type (string, int, etc);

function citiesList() : void
{
    echo(require_once "cities.json");
}

function cityController($city, $headers) : void
{
    if (str_contains($headers, "application/x-maps")){
        cityMap($city);
    }
    if (str_contains($headers, "text"))
    {
        cityInfo($city);
    }
    //TODO return something if anything
}

//TODO : test if person exits

function cityInfo($citySearched): void
{
    $file =  file_get_contents("cities.json");
    $cities = json_decode($file, true);

    foreach ($cities as $city)
    {
        if ($citySearched == $city['CP']){
            echo "Welcome to " . $city['name'] .
                " with a postal code of " . $city['CP'];
        }
            
        // TODO return 200
    }
    //TODO : return error 400
}

function cityMap($citySearched): void
{

}