<?php
namespace App\Libraries;

class ReadFile{
    public static function getFileType($file){
        $e = explode('.',$file);
        return end($e);
    }
}
