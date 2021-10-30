<?php
namespace App\Http\Controllers;

use App\Helper\ProcessFile\ProcessFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller{
    public function upload(Request $request){

        $file = public_path()."/files/challenge__1_.json";
        $process = new ProcessFactory();  //initialize process factory
        $process = $process->initialize('json'); //pass file type. default is json
        $process->process($file);
        $response['message'] = 'done';
        return response()->json($response, 200);
    }
}
