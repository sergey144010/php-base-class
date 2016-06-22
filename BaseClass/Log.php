<?php
namespace sergey144010;

use sergey144010\BaseException;

class Log
{
    protected static $logTurn = 'on';
    protected static $logDir = 'log';
    protected static $logFile = 'log.txt';
    /*
     * Size in Mb
     */
    protected static $logSize = '3';

    public static function check()
    {
        if(
            is_file(self::$logDir.DIRECTORY_SEPARATOR.self::$logFile)
            &&
            filesize(self::$logDir.DIRECTORY_SEPARATOR.self::$logFile)>(self::$logSize*1024*1024)
        ){
            $handle = fopen(self::$logDir.DIRECTORY_SEPARATOR.self::$logFile, "w");
            fwrite($handle,"");
            fclose($handle);
        };
    }

    public static function add($string)
    {
        if(self::$logTurn == "on"){
            if(is_string($string)){
                $time = date("[Y-m-d H:i:s]");
                $string = $time." ".$string.PHP_EOL;
                echo $string;
                $fileSave = self::$logDir.DIRECTORY_SEPARATOR.self::$logFile;
                if(is_file($fileSave)){
                    $write = file_put_contents($fileSave, $string, FILE_APPEND);
                    if($write === false){
                        throw new BaseException ('Write to file log failed');
                    };
                }else{
                    if(is_dir(self::$logDir)){
                        $handle = fopen($fileSave,'a+');
                        if($handle === false){
                            throw new BaseException ('Failed create log file');
                        };
                        fclose($handle);
                        $write = file_put_contents($fileSave, $string, FILE_APPEND);
                        if($write === false){
                            throw new BaseException ('Write to file log failed');
                        };
                    }else{
                        throw new BaseException ('Create a directory '.self::$logDir.' for the log file');
                    };
                };
            }else{
                $type = gettype($string);
                self::add("Error Log : Given variable is not a string - ".$type);
            };
        };
    }
}