<?php
namespace App\Helper\StreamingParser;
class StreamingParserFactory{
    public function initialize($file, $type=''){
        switch ($type){
            case 'json':
                return new JsonStreamingParser($file);
            default:
                return new JsonStreamingParser($file);
        }
    }
}
