<?php

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
    elseif (str_contains($headers, "text"))
    {
        echo "info";
        personInfo($person);
    }
    //TODO return something if anything
}

//test
function personInfo($personSearched)
{
    $people =  file_get_contents("people.json");
    $file = json_decode($people, true);

    foreach ($file as $person)
    {
        if ($personSearched == $person['id'])
        echo($person['id']);
        return;
        // TODO return 200
    }
    echo "The id isnt found !";
    //TODO : return error 400
}

function personImage($person)
{
    echo("image");
}