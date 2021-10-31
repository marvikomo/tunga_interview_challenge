<?php
namespace App\Helper\ProcessFile;

use App\Jobs\ProcessFile;
use App\Jobs\UploadFile;
use Illuminate\Support\Facades\Bus;

class ProcessJSON implements ProcessInterface {

    public function process($file)
    {
        $file_data = json_decode(file_get_contents($file), true);
        ProcessFile::dispatch($file_data);
    }
}
