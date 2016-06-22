<?php

namespace sergey144010;

use sergey144010\BaseException;

class Object
{
    public static function create($class, $interface = null, $data = null)
    {
        if(isset($interface)){
            if(class_exists($class)){
                $class = new $class($data);
                if($class instanceof $interface){
                    return $class;
                }else{
                    throw new BaseException ('Class '.$class.' not instance interface '.$interface);
                }
            }else{
                throw new BaseException ('Class '.$class.' not found');
            }
        };
        if(class_exists($class)){
            return new $class($data);
        }else{
            throw new BaseException ('Class '.$class.' not found');
        }
    }
}