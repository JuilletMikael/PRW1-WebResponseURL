<?php

class NotAcceptableMimeException extends Exception
{
    public function __construct($message = "The MIME header is missing in the request.", $code = 406, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}