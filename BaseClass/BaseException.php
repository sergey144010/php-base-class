<?php

namespace sergey144010;

use \Exception;

class BaseException extends Exception
{
    public function getError($TraceAsString = null)
    {
        $string = PHP_EOL;
        $string .= 'BaseException : '.parent::getMessage().PHP_EOL;
        $string .= "Error in file : ";
        $string .= parent::getFile().PHP_EOL;
        $string .= "Error on line : ";
        $string .= parent::getLine();
        #$string .= PHP_EOL;

        if(isset($TraceAsString)){
            $string .= parent::getTraceAsString().PHP_EOL;
        };

        #echo $string;
        return $string;
    }
}