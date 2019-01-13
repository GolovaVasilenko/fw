<?php

namespace Core\DataBase;

trait TFilter {

    public static function clearData($data)
    {
        if(is_numeric($data)){
            return (int)$data;
        }

        if(is_string($data)){
            return static::clearStr($data);
        }

        if(is_array($data)){
            foreach($data as $key => &$item){
                if(is_numeric($item) and 'artikul' != $key){
                    $item = (int) $item;
                }

                if(is_string($item)){
                    if('body' === $key or 'content' === $key)
                        continue;
                    $item = static::clearStr($item);
                }
            }
        }
        return $data;
    }

    public static function clearStr($str)
    {
        return htmlspecialchars(strip_tags(stripslashes(trim($str))));
    }
}