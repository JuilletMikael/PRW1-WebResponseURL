<?php

function peopleController($uriExplode, $mims)
{
    require_once "models/mims.php";
    $mim = mimCheck($mims, ["text/*", "text/html", "image/*", "image/jpg"]); //TODO : If doesnt exist trow an error

    if(count($uriExplode) <3 ) showPeopleList("people.json");
    else
    {
        require_once "models/json.php";
        $personInformation = findInJson("people.json", $uriExplode[2]);
    }
    //TODO : If it doesn't exist throw error

    if ($personInformation && str_contains($mim, "text")) showPersonInformation($personInformation);
    elseif ($personInformation && str_contains($mim, "image")) showPersonImage($personInformation["id"]);
}

function showPersonImage($id)
{
    $file = __DIR__ . "image/" . $id;
    $fileopen = fopen($file, "rb");

    header("Content-Type: image/jpg");
    header("Content-Length: " . filesize($file));

    fpassthru($fileopen);
    exit;
}

function showPersonInformation($info) :void
{
    $message = "Hello " . $info['name'] . " your " . $info['age'] .
        " and your SECRET identity is " . $info['secretIdentity'] . "!";
    echo $message;
}

function showPeopleList($jsonFilePath) :void
{
    $file =  file_get_contents($jsonFilePath);
    $content = json_decode($file, true);
    $message = "All id's available ";

    foreach ($content as $value){
        $message .= $value['id'] . "; ";
    }

    echo $message;
}
