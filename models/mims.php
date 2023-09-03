<?php

function mimCheck($mims, $allowedMims)
{
    if (!$mims) echo"no mims 415";

    foreach ($mims as $mim){
        for ($i = 0; $i < count($allowedMims); $i++) {
            if ($allowedMims[$i] == $mim) return $mim;
        }
    }
}