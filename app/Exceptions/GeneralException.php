<?php

namespace App\Exceptions;

class GeneralException extends \Exception
{

    protected $message = 'An error occured';
    protected $code = 500;
    protected $source = "product-service";
}
