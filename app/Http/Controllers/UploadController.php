<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessFile;
use App\Libraries\ReadFile;
use Illuminate\Http\Request;

class UploadController extends Controller{
    public function upload(Request $request){
        $file = public_path()."/files/challenge__1_.json";
        ProcessFile::dispatch($file,ReadFile::getFileType($file));
        $response['message'] = 'done';
        return response()->json($response, 200);
    }
}
