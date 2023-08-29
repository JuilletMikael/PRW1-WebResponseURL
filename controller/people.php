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
        personImage($person);
    }
    else
    {
        personInfo();
    }
}

function personInfo($person)
{
    $people = json_decode("people.json");

    foreach ($people->{'people'} as $person)
    {

    }
}

function personImage($person)
{
    echo("image");
}