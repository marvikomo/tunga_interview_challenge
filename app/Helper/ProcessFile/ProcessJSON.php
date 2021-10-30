<?php
namespace App\Helper\ProcessFile;

class ProcessJSON implements ProcessInterface {

    public function process($file)
    {
        $file_data = json_decode(file_get_contents($file), true);
    }
}
