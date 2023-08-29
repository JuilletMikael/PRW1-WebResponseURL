<?php

function peopleController($uri, $header)
{

}

function peopleList()
{
    echo(require_once "people.json");
}

function getPerson($person, $headers)
{
    if (str_contains($headers, "image")){
        echo "image";
        personImage($person);
    }
    else
    {
        echo "info";
        personInfo($person);
    }
}

//test
function personInfo($personSearched)
{
    $people =  file_get_contents("people.json");
    $file = json_decode($people, true);

    foreach ($file as $person)
    {
        echo($person['id']);
    }
}

function personImage($person)
{
    echo("image");
}