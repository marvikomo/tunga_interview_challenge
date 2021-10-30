<?php
namespace App\Helper\ProcessFile;

class ProcessFactory{
    private $file_type;
    public function __construct($file_type)
    {
        $this->file_type = $file_type;
    }
    public function initialize(string $type=''){
        switch ($type){
            case 'json':
                return new ProcessJSON();
            default:
                return new ProcessJSON();
        }
    }
}
