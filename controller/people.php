<?php
//TODO : Use php 8 varriable with value (string, int, etc);

function peopleList() : void
{
    echo(require_once "people.json");
}

function personController($person, $headers) : void
{
    if (str_contains($headers, "image")){
        echo "image";
        personImage($person);
    }
    elseif (str_contains($headers, "text"))
    {
        echo "info";
        personInfo($person);
    }
    //TODO return something if anything
}

//TODO : test if person exeits

function personInfo($personSearched): void
{
    $file =  file_get_contents("people.json");
    $people = json_decode($file, true);

    foreach ($people as $person)
    {
        if ($personSearched == $person['id'])
        echo($person);
        return;
        // TODO return 200
    }
    echo "The id isn't found !";
    //TODO : return error 400
}

function personImage($personSearched): void
{
    $imageDirectory = "/image/";
    $imageFile = $imageDirectory . $personSearched . ".jpg";

    if (file_exists($imageFile))
    {

        return;
    }
    // TODO return 200
    echo "The id isn't found !";
}