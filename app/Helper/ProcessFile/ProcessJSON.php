<?php
namespace App\Helper\ProcessFile;

use App\Jobs\UploadFile;
use Illuminate\Support\Facades\Bus;

class ProcessJSON implements ProcessInterface {

    public function process($file)
    {
        //broke large files into chunks before dispatching
        $file_data = json_decode(file_get_contents($file), true);
        $chunks = array_chunk($file_data, 1000);
        $batch = Bus::batch([])->dispatch();
        foreach ($chunks as $key => $chunk){
            $batch->add(new UploadFile($chunk));
        }
        dd($batch);
    }
}
