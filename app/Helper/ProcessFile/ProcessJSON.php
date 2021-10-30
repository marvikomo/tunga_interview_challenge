<?php
namespace App\Helper\ProcessFile;

use App\Libraries\DateLib;
use Illuminate\Support\Facades\Bus;

class ProcessJSON implements ProcessInterface {

    public function process($file)
    {
        $file_data = json_decode(file_get_contents($file), true);
        $date_lib = new DateLib();
        $chunks = array_chunk($file_data, 1000);
        $batch = Bus::batch([])->dispatch();
        foreach ($chunks as $key => $chunk){
            $batch->add();
        }
    }
}
