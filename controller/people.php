<?php

function peopleController($uriExplode, $mims)
{
    try {
        require_once "models/mims.php";
        $mim = mimCheck($mims, ["text/*", "text/html", "image/*", "image/jpg"]);
        if (!isset($mim)) {
            require_once "NotAcceptableMimeException.php";
            throw new NotAcceptableMimeException();
        }
    } catch (NotAcceptableMimeException $e) {
        header("HTTP/1.1 406 Not Acceptable");
        header("Content-Type: text/plain");
        echo "Erreur : " . $e->getMessage();
    }

    if(count($uriExplode) <3 ) showPeopleList("people.json");
    else
    {
        $personInformation = findPersonInJson("people.json", $uriExplode[2]);
        if (!$personInformation) {
            header("HTTP/1.1 404 Bad Request");
            header("Content-Type: text/plain");
        }
    }

    if ($personInformation && str_contains($mim, "text")) showPersonInformation($personInformation);
    elseif ($personInformation && str_contains($mim, "image")) showPersonImage($personInformation["id"]);
}

function showPersonImage($id)
{
    $file = __DIR__ . "image/" . $id;
    $fileopen = fopen($file, "rb");

    header("Content-Type: image/jpg");
    header("Content-Length: " . filesize($file));

    header("HTTP/1.1 200 OK");
    header("Content-Type: image/jpg");

    fpassthru($fileopen);
    exit;
}

function showPersonInformation($info) :void
{
    $message = "Hello " . $info['name'] . " your " . $info['age'] .
        " and your SECRET identity is " . $info['secretIdentity'] . "!";

    header("HTTP/1.1 200 OK");
    header("Content-Type: text/html");

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

    header("HTTP/1.1 200 OK");
    header("Content-Type: text/html");

    echo $message;
}

function findPersonInJson($jsonFilePath, $searchableValue)
{
    $file =  file_get_contents($jsonFilePath);
    $content = json_decode($file, true);

    foreach ($content as $value)
    {
        if ($searchableValue == $value['id'])
            return $value;
    }
}
