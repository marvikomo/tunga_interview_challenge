<?php
namespace App\Http\Controllers\Upload;

use App\Helper\ProcessFile\ProcessFactory;
use App\Http\Controllers\Controller;

class UploadController extends Controller{
    public function upload(){
        $file = storage_path('app/files')."/challenge__1_.json"; //read file from storage
        $process = new ProcessFactory();  //initialize process factory
        $process = $process->initialize('json'); //pass file type. default is json
        $process->process($file);

    }
}
