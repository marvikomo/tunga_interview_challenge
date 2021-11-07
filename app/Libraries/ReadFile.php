<?php
namespace App\Libraries;
use pcrov\JsonReader\JsonReader;

class ReadFile{
    public static function getFileType($file){
        $e = explode('.',$file);
        return end($e);
    }
}
