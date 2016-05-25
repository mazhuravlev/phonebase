<?php

namespace App\System;


class Source
{

    public static function hasUrl($source)
    {
        return in_array($source, ['avito', 'olx'], true);
    }

    public static function url($source, $id)
    {
        switch ($source) {
            case 'avito':
                return "https://avito.ru/$id";
            case 'olx':
                return "http://olx.ua/obyavlenie/-ID$id.html";
            default:
                throw new \ErrorException();
        }
    }

}