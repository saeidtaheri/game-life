<?php

namespace App\Exceptions;
use Exception;

class InvalidPatternException extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid pattern template provided.');
    }
}