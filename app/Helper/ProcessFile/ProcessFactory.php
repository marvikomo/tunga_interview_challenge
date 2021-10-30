<?php
namespace App\Helper\ProcessFile;

class ProcessFactory{
    public function initialize(string $type){
        switch ($type){
            case 'csv':
                return new ProcessJSON();
        }
    }
}
