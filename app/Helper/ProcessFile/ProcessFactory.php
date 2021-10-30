<?php
namespace App\Helper\ProcessFile;

class ProcessFactory{
    public function initialize(string $type=''){
        switch ($type){
            case 'json':
                return new ProcessJSON();
            default:
                return new ProcessJSON();
        }
    }
}
