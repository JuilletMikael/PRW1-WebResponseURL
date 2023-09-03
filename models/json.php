<?php

function findInJson($jsonFilePath, $searchableValue)
{
    $file =  file_get_contents($jsonFilePath);
    $content = json_decode($file, true);

    foreach ($content as $value)
    {
        foreach ($value as $item) {
            if ($searchableValue == $item)
                return $value;
        }
    }
}

