<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 22:24
 */


class DB
{
    public static function query($query)
    {
        $mysqli=new mysqli('localhost', 'root', 'root', 'bit');
        if($result=$mysqli->query($query))
        {
            return $result;
        }
        return false;
    }
}